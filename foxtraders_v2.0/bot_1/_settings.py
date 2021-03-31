from run import *

# ______________________________________________________________________
# Check ENV
# print('ENV: ',os.getenv('MY_ENV'))

# ______________________________________________________________________

from sqlalchemy import create_engine, Column, DateTime, String, Numeric, Integer, func, DECIMAL, Float, Text
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import sessionmaker

# ______________________________________________________________________

if os.getenv('MY_ENV') == 'work':        
    db_address = os.getenv('DB_WORK')
elif os.getenv('MY_ENV') == 'home': 
    db_address = os.getenv('DB_HOME')
else:
    db_address = os.getenv('DB_PRO')

# ______________________________________________________________________

engine = create_engine(db_address)
Session = sessionmaker()
Session.configure(bind=engine)
session = Session()
Base = declarative_base()
# ______________________________________________________________________

class Fxt_Settings(Base):
    __tablename__ = 'fxt_settings'

    id = Column(Integer, primary_key=True)
    name = Column(String(50), unique=True)
    value = Column(String(50))
    info = Column(String(255))

    def __init__(self, name, value, info=None):
        self.name = name
        self.value = value
        self.info = info

# ______________________________________________________________________

Base.metadata.create_all(engine)

########################################################################

if __name__ == '__main__':

    # __________________________________________________________________

    bot_on      = Fxt_Settings('bot_on' , '1', 'Value 0 or 1') 

    symbol1     = Fxt_Settings('symbol1', 'ada', 'Crypto to Buy')
    symbol2     = Fxt_Settings('symbol2', 'usdt','Base Currency') 

    buy_price        = Fxt_Settings('buy_price', '0.00', 'Set it if in_postion')

    in_position      = Fxt_Settings('in_position', '0', 'Value 0 or 1')
    sell_conditions  = Fxt_Settings('sell_conditions', '0', 'Value 0 or 1')
    buy_conditions   = Fxt_Settings('buy_conditions', '0', 'Value 0 or 1')

    sell_qty    = Fxt_Settings('sell_qty', '10') 
    buy_qty     = Fxt_Settings('buy_qty', '10') 

    sma_window  = Fxt_Settings('sma_window', '36' , 'Default Value 36')
    ema_window  = Fxt_Settings('ema_window', '144', 'Default Value 144') 

    sma_offset  = Fxt_Settings('sma_offset', '0', 'Default Value 0')
    ema_offset  = Fxt_Settings('ema_offset', '0', 'Default Value 0') 

    sell_percentage = Fxt_Settings('sell_percentage', '1.08', 'Default 1.08 => +8%      Differane between SMA & EMA')
    sell_in_profit  = Fxt_Settings('sell_in_profit', '1.25',  'Default 1.35 => +35%     Price over buy_price')
    over_sma        = Fxt_Settings('over_sma', '1.175',       'Default 1.175 => +17.5%  Price over SMA')

    buy_gap     = Fxt_Settings('buy_gap',   '1.006', 'Default 1.006 => 0.6%')
    rebuy_gap   = Fxt_Settings('rebuy_gap', '1.006', 'Default 1.006 => 0.6%')
    rebuy_count = Fxt_Settings('rebuy_count', '0', 'Default 0')
    rebuy_max   = Fxt_Settings('rebuy_max',   '5', 'Default 5')

    msl_on   = Fxt_Settings('msl_on',  '1',    'Default 1 => True')
    msl_per  = Fxt_Settings('msl_per', '0.95', 'Default 0.95 => -5%')



    # __________________________________________________________________

    session.add(bot_on)

    session.add(symbol1)
    session.add(symbol2)

    session.add(buy_price)

    session.add(in_position)
    session.add(sell_conditions)
    session.add(buy_conditions)

    session.add(sell_qty)
    session.add(buy_qty)

    session.add(sma_window)
    session.add(ema_window)

    session.add(sma_offset)
    session.add(ema_offset)

    session.add(sell_percentage)
    session.add(sell_in_profit)
    session.add(over_sma)

    session.add(buy_gap)
    session.add(rebuy_gap)
    session.add(rebuy_count)
    session.add(rebuy_max)
    session.add(msl_on)
    session.add(msl_per)

    # ______________________________________

    session.commit() 

    # __________________________________________________________________ 


  


    