#!/usr/bin/python3.9
# ______________________________________________________________________
'''Imports'''
import os, socket

# ______________________________________________________________________
'''Selecting envierment'''

hostname = socket.gethostname()

if hostname == 'Luke_Desktop':
    my_env = 'work'
elif hostname == 'foxcodenine-NC-V3-571G-73638':
    my_env = 'home'
else:
    my_env = 'production'

# ______________________________________________________________________
'''Selecting venv dir & project dir'''

if my_env   == 'home':
    activate_this  = '/home/foxcodenine/.local/share/virtualenvs/bot_1-ed9ImTCi/bin/activate_this.py'
    project_folder = '/home/foxcodenine/Desktop/foxtraders/bot_1'
elif my_env == 'work':
    activate_this  = r'C:\Users\chris.GPC\.virtualenvs\bot_1-ZpvTSjAf\Scripts\activate_this.py'
    project_folder = r'C:\origin\foxtraders\bot_1'
else:
    activate_this  = '/root/.local/share/virtualenvs/bot_1-FUXvTGGx/bin/activate_this.py'
    project_folder = '/home/foxtraders/bot_1'

# ______________________________________________________________________
'''Loading venv & .env'''


with open(activate_this) as file_:
    exec(file_.read(), dict(__file__=activate_this)) 

from dotenv import load_dotenv

load_dotenv(os.path.join(project_folder, '.env'), override=True)

if my_env == 'home' or my_env == 'work':
    os.environ['FLASK_ENV'] = 'development'
else:
    os.environ['FLASK_ENV'] = 'production'

os.environ['MY_FLASK_ENV'] = my_env

# ______________________________________________________________________
'''Starting app'''

if __name__ == '__main__':
    from my_web import app
    
    app.run(host='0.0.0.0', port=5559)