import os
import sys
import json
import pickle
import face_recognition
import numpy as np
from db_config import get_db_connection

if len(sys.argv) < 2:
    print(json.dumps({"status": "error", "message": "Missing image path argument"}))
    sys.exit(1)

image_path = sys.argv[1]


# Load captured image

if not os.path.exists(image_path):
    print(json.dumps({"status": "error", "message": "Image file not found"}))
    sys.exit(1)

try:
    image          = face_recognition.load_image_file(image_path)
    face_locations = face_recognition.face_locations(image, model="hog")
    face_encodings = face_recognition.face_encodings(image, face_locations)
except Exception as e:
    print(json.dumps({"status": "error", "message": f"Face detection failed: {e}"}))
    sys.exit(1)

if len(face_encodings) == 0:
    print(json.dumps({"status": "error", "message": "No face detected in image"}))
    sys.exit(1)


# Load ALL student encodings

try:
    db     = get_db_connection()
    cursor = db.cursor()

    cursor.execute("""
        SELECT id, user_id, firstname, lastname, face_encoding 
        FROM userlist 
        WHERE face_encoding IS NOT NULL
    """)

    students = cursor.fetchall()
    cursor.close()
    db.close()

except Exception as e:
    print(json.dumps({"status": "error", "message": f"DB fetch failed: {e}"}))
    sys.exit(1)

if len(students) == 0:
    print(json.dumps({"status": "error", "message": "No registered faces found in database"}))
    sys.exit(1)


# Compare faces

matched = []

for (sid, user_id, firstname, lastname, encoding_blob) in students:
    try:
        known_encoding = pickle.loads(encoding_blob)
        distances      = face_recognition.face_distance(face_encodings, known_encoding)
        min_distance   = float(np.min(distances))

        if min_distance < 0.5:
            matched.append({
                "user_id":  user_id,
                "name":     firstname + " " + lastname,
                "distance": round(min_distance, 4)
            })
    except Exception:
        continue


# Return result

print(json.dumps({
    "status":              "success",
    "matched":             matched,
    "total_faces_detected": len(face_encodings)
}))