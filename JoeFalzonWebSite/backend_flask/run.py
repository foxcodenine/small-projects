from dotenv import load_dotenv 
import os 

project_folder = os.path.expanduser(os.getcwd())

load_dotenv(os.path.join(project_folder, '.env'))

from my_app import app


if __name__ == "__main__":
    # app.run()
    app.run(host='0.0.0.0', port=5559)