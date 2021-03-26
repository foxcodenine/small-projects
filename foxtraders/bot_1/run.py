#!/usr/bin/python3.9
# ______________________________________________________________________
'''Imports'''
import os, socket

# ______________________________________________________________________
'''Selecting envierment'''

hostname = socket.gethostname()

if hostname == 'Luke_Desktop':
    my_env = 'work'
elif hostname == 'foxcodenine':
    my_env = 'work'
else:
    my_env = 'production'

# ______________________________________________________________________
'''Selecting venv dir & project dir'''

if my_env   == 'home':
    activate_this  = '/home/foxcodenine/.local/share/virtualenvs/bot_1-r5DZ6mnM/bin/activate_this.py'
    project_folder = '/home/foxcodenine/Desktop/foxtraders/bot_1'
elif my_env == 'work':
    activate_this  = r'C:\Users\chris.GPC\.virtualenvs\bot_1-ZpvTSjAf\Scripts\activate_this.py'
    project_folder = r'C:\origin\foxtraders\bot_1'
else:
    activate_this  = ''
    project_folder = ''

# ______________________________________________________________________
'''Loading venv & .env'''


with open(activate_this) as file_:
    exec(file_.read(), dict(__file__=activate_this)) 

from dotenv import load_dotenv

load_dotenv(os.path.join(project_folder, '.env'), override=True)
os.environ['MY_ENV'] = my_env

# ______________________________________________________________________
'''Starting app'''

if __name__ == '__main__':
    import my_app