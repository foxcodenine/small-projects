import my_app.config as cfg 

from my_app.database import Session, Fxt_Action, Fxt_Error, Fxt_Parameters, Fxt_Settings

from my_app import ta_functions as ta
from my_app import my_functions as myf


# ______________________________________________________________________


def trade_conditions():

    if cfg.in_position:
        print('in_position')


    if not cfg.in_position:        

        if not cfg.buy_conditions and cfg.cur_close <= cfg.cur_ma:

            cfg.buy_conditions = True

            message = '<buy condition on>'
            
            myf.log_action(cfg.cur_close, message)    
            myf.log_parameters()
            print(message)
        else:
            print('not_in_position')