from my_app.global_variables import *
from my_app import my_function as myf

def buying_conditions():
    print(p_1)
    if p_1['active'] == False:
        myf.activate('P1')
        myf.import_settings('P1')
    else:
        myf.deactivate('P1')
        myf.import_settings('P1')


