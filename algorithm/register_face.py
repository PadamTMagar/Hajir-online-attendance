import cv2
import face_recognition
import pickle
import os
import sys
from db_config import get_db_connection

# ----------------------------
# 1️⃣ Get user ID from PHP
# ----------------------------
if len(sys.argv) < 2:
    print("User ID not provided")
    sys.exit()

student_id = sys.argv[1]

# ----------------------------
# 2️⃣ Connect to DB
# ----------------------------
db = get_db_connection()
cursor = db.cursor()

# ----------------------------
# 3️⃣ Open Webcam
# ----------------------------
video_capture = cv2.VideoCapture(0)

if not video_capture.isOpened():
    print("Webcam not accessible")
    sys.exit()

print("Press 'S' to capture image")

while True:
    ret, frame = video_capture.read()
    cv2.imshow("Face Registration", frame)

    if cv2.waitKey(1) & 0xFF == ord('s'):
        break

video_capture.release()
cv2.destroyAllWindows()

# ----------------------------
# 4️⃣ Convert to RGB
# ----------------------------
rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)

# ----------------------------
# 5️⃣ Detect Face
# ----------------------------
face_locations = face_recognition.face_locations(rgb_frame)

if len(face_locations) != 1:
    print("Ensure exactly one face is visible")
    sys.exit()

# ----------------------------
# 6️⃣ Generate Encoding
# ----------------------------
encoding = face_recognition.face_encodings(rgb_frame, face_locations)[0]

# ----------------------------
# 7️⃣ Save Image
# ----------------------------
image_folder = "../profilePic"

if not os.path.exists(image_folder):
    os.makedirs(image_folder)

filename = f"student_{student_id}.jpg"
image_save_path = os.path.join(image_folder, filename)

cv2.imwrite(image_save_path, frame)

# Store relative path in DB
db_image_path = f"profilePic/{filename}"

# ----------------------------
# 8️⃣ Convert Encoding
# ----------------------------
encoding_binary = pickle.dumps(encoding)

# ----------------------------
# 9️⃣ Update Database
# ----------------------------
cursor.execute("""
    UPDATE userlist
    SET profile_pic = %s,
        face_encoding = %s
    WHERE id = %s
""", (db_image_path, encoding_binary, student_id))

db.commit()

print("Registration Completed Successfully")

cursor.close()
db.close()
