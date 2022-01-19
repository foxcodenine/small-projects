from run import *
from my_app.database import *
import os 

# __________________________________________________________________

if __name__ == '__main__':
        
    try:
        Fxt_Settings.__table__.drop(engine)
        Fxt_Parameters.__table__.drop(engine)
        Fxt_Error.__table__.drop(engine)
        Fxt_Action.__table__.drop(engine)
        Fxt_Data.__table__.drop(engine)

        session.commit()
        
    except:
        pass

    Base.metadata.create_all(engine)
    
# __________________________________________________________________

    
    active      = Fxt_Settings('active' , '0', 'Value 0 or 1') 

    symbol1     = Fxt_Settings('symbol1', os.getenv('SYMBOL1'), 'Crypto to Buy')
    symbol2     = Fxt_Settings('symbol2', os.getenv('SYMBOL2'),'Base Currency') 

    restart_time = Fxt_Settings('restart_time', os.getenv('RESTART_TIME'),'time in seconds')

    session.add(active)
    session.add(symbol1)
    session.add(symbol2)
    session.add(restart_time)

    session.commit()

# __________________________________________________________________

    symbol = '{} / {}'.format(os.getenv('SYMBOL1'), os.getenv('SYMBOL2'))

    session.add(Fxt_Parameters('symbol', symbol, 'Trading Pairs'))

    session.add(Fxt_Parameters('--------------------', '--------------------', '--------------------'))

    session.add_all([
        Fxt_Parameters('in_position', 0 , '0 => False, 1 = True'),
        Fxt_Parameters('sell_conditions', 0, '0 => False, 1 = True'),
        Fxt_Parameters('buy_conditions', 0, '0 => False, 1 = True'),
        # Fxt_Parameters('target_reached', 0, '0 => False, 1 = True')
    ])

    session.add(Fxt_Parameters('--------------------', '--------------------', '--------------------'))

    session.add(Fxt_Parameters('cur_buy_price', None, ' '))

    session.add(Fxt_Parameters('--------------------', '--------------------', '--------------------'))

    session.add_all([
        Fxt_Parameters('buy_qty',  0, 'Symbol1'),
        Fxt_Parameters('sell_qty', 0, 'Symbol2'),
        Fxt_Parameters('sell_target', 0, '% Percentage'),
        Fxt_Parameters('buy_trail',   0, '% Percentage'),
        Fxt_Parameters('sell_trail',  0, '% Percentage')
    ])

    session.add(Fxt_Parameters('--------------------', '--------------------', '--------------------'))

    session.add_all([
        Fxt_Parameters('sma_window', 0, 'hr Default 240'),
        Fxt_Parameters('ema_window', 0, 'hr Default 240'),
        Fxt_Parameters('ma_type', 'ema', 'sma or ema'),
        Fxt_Parameters('ma_offset',  0, '% `+` move up, `-` move down')
    ])


    session.add(Fxt_Parameters('--------------------', '--------------------', '--------------------'))

    session.add_all([
        Fxt_Parameters('msl_on',  0, '0 => False, 1 = True'),
        Fxt_Parameters('msl_per', 0, '% Percentage')
    ])


    session.commit()