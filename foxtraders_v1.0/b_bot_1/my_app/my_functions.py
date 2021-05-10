import my_app.config as cfg 
from my_app.database import Session, Fxt_Action, Fxt_Error, Fxt_Parameters, Fxt_Settings


# ______________________________________________________________________

session = Session()

# ______________________________________________________________________

def import_settings():

    cfg.active = bool(int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'active').first().value))
    cfg.symbol1 = session.query(Fxt_Settings).filter(Fxt_Settings.name == 'symbol1').first().value.upper()
    cfg.symbol2 = session.query(Fxt_Settings).filter(Fxt_Settings.name == 'symbol2').first().value.upper()
    cfg.symbol = cfg.symbol1 + cfg.symbol2
    cfg.restart_time = int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'restart_time').first().value.upper())

    print('\nUpdate Settings >>', cfg.symbol)

    session.close()

def import_parameters():
    
    cfg.in_position = bool(int(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'in_position').first().value))
    cfg.sell_conditions = bool(int(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'sell_conditions').first().value))
    cfg.buy_conditions  = bool(int(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'buy_conditions').first().value))
    cfg.target_reached  = bool(int(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'target_reached').first().value))

    cur_buy_price = (session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'cur_buy_price').first().value)

    if cur_buy_price: cfg.cur_buy_price = float(cur_buy_price)

    cfg.buy_qty = float(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'buy_qty').first().value) 
    cfg.sell_qty = float(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'sell_qty').first().value) 

    cfg.sell_target = 1 + (float(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'sell_target').first().value) / 100)
    cfg.buy_trail   = 1 + (float(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'buy_trail').first().value) / 100)
    cfg.sell_trail  = 1 - (float(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'sell_trail').first().value) / 100)

    cfg.sma_window = int(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'sma_window').first().value)
    cfg.ema_window = int(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'ema_window').first().value)
    cfg.ma_type = session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'ma_type').first().value
    cfg.ma_offset = 1 + (float(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'ma_offset').first().value) / 100)

    cfg.msl_on = bool(int(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'msl_on').first().value))
    cfg.msl_per = 1 - (float(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'msl_per').first().value) / 100)

    print('\nUpdate Parameters >>')
    session.close() 
