import os
import sys

# Force load conda env DLLs before any other import
conda_env = r"C:\Users\acer\anaconda3\envs\facereco"

# Add all necessary paths
sys.path.insert(0, os.path.join(conda_env, "Lib", "site-packages"))
sys.path.insert(0, conda_env)

# Add DLL directories for dlib/face_recognition
dll_paths = [
    os.path.join(conda_env, "Library", "bin"),
    os.path.join(conda_env, "Library", "mingw-w64", "bin"),
    os.path.join(conda_env, "Library", "usr", "bin"),
    os.path.join(conda_env, "Scripts"),
    conda_env,
]

for p in dll_paths:
    if os.path.isdir(p):
        os.add_dll_directory(p)  # Python 3.8+ Windows only
        os.environ["PATH"] = p + ";" + os.environ.get("PATH", "")

import pickle
import face_recognition
from db_config import get_db_connection



import os
import sys
import pickle
import face_recognition
from db_config import get_db_connection

# ----------------------------
# 1. Get user_id from argument
# ----------------------------
if len(sys.argv) < 2:
    print("error: user_id not provided")
    sys.exit(1)

user_id = sys.argv[1]

# ----------------------------
# 2. Build absolute image path
# ----------------------------
script_dir = os.path.dirname(os.path.abspath(__file__))   # .../algorithm
project_root = os.path.dirname(script_dir)                # .../Hajir

image_relative_db_path = f"profilePic/student_{user_id}.jpg"
image_full_path = os.path.join(project_root, "profilePic", f"student_{user_id}.jpg")

print(f"debug: image path = {image_full_path}")

if not os.path.exists(image_full_path):
    print("error: image file not found")
    sys.exit(1)

# ----------------------------
# 3. Load image
# ----------------------------
try:
    image = face_recognition.load_image_file(image_full_path)
    print(f"debug: image loaded successfully, shape = {image.shape}")
except Exception as e:
    print(f"error: unable to load image - {e}")
    sys.exit(1)

# ----------------------------
# 4. Detect face
# ----------------------------
try:
    face_locations = face_recognition.face_locations(image, model="hog")
except Exception as e:
    print(f"error: face detection failed - {e}")
    sys.exit(1)

if len(face_locations) == 0:
    print("error: no face detected")
    sys.exit(1)

if len(face_locations) > 1:
    print("error: multiple faces detected")
    sys.exit(1)

# ----------------------------
# 5. Generate encoding
# ----------------------------
try:
    encodings = face_recognition.face_encodings(image, face_locations)

    if len(encodings) == 0:
        print("error: face encoding could not be generated")
        sys.exit(1)

    face_encoding = encodings[0]
except Exception as e:
    print(f"error: encoding failed - {e}")
    sys.exit(1)

# convert numpy array to binary for MySQL LONGBLOB
encoding_binary = pickle.dumps(face_encoding)

# ----------------------------
# 6. Update database
# ----------------------------
try:
    db = get_db_connection()
    cursor = db.cursor()

    # verify user exists
    cursor.execute("SELECT id FROM userlist WHERE id = %s", (user_id,))
    user = cursor.fetchone()

    if not user:
        print("error: user not found in userlist")
        cursor.close()
        db.close()
        sys.exit(1)

    update_query = """
        UPDATE userlist
        SET profile_pic = %s,
            face_encoding = %s
        WHERE id = %s
    """

    cursor.execute(update_query, (image_relative_db_path, encoding_binary, user_id))
    db.commit()

    cursor.close()
    db.close()

    print("success")

except Exception as e:
    print(f"error: database update failed - {e}")
    sys.exit(1)