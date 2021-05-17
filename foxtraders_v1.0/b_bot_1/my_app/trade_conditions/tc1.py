import my_app.config as cfg 

from my_app.database import Session, Fxt_Action, Fxt_Error, Fxt_Parameters, Fxt_Settings

from my_app import ta_functions as ta
from my_app import my_functions as myf


# ______________________________________________________________________


def trade_conditions():

    if cfg.in_position:
 
 
        if not cfg.sell_conditions and cfg.cur_close >= cfg.cur_buy_price * cfg.sell_target:

            # cfg.in_position     = True
            # cfg.buy_conditions  = False
            cfg.sell_conditions = True
            
            cfg.cur_atl = cfg.cur_close
            cfg.cur_ath = cfg.cur_close

            message = '<sell condition on>'
            
            myf.log_action(message)    
            myf.log_parameters()
            print(message)






    if not cfg.in_position:        

        if not cfg.buy_conditions and cfg.cur_close <= cfg.cur_ma:
            # reset buy contitions

            # cfg.in_position     = False
            cfg.buy_conditions  = True
            # cfg.sell_conditions = False

            cfg.cur_atl = cfg.cur_close
            cfg.cur_ath = cfg.cur_close

            message = '<buy condition on>'
            
            myf.log_action(message)    
            myf.log_parameters()
            print(message)





        if cfg.buy_conditions and cfg.cur_close >= cfg.cur_atl * cfg.buy_trail:
            # BUY
            pass
