# ______________________________________________________________________

from sqlalchemy import create_engine, Column, DateTime, String, Numeric, Integer, func, DECIMAL, Float, Text
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import sessionmaker

import os
# ______________________________________________________________________
# import db_address


if os.getenv('MY_ENV') == 'work':        
    db_address = os.getenv('DB_WORK') + os.getenv('DB_NAME')
elif os.getenv('MY_ENV') == 'home': 
    db_address = os.getenv('DB_HOME') + os.getenv('DB_NAME')
else:
    db_address = os.getenv('DB_PRO')  + os.getenv('DB_NAME')


# ______________________________________________________________________

engine = create_engine(db_address)
Session = sessionmaker()
Session.configure(bind=engine)
session = Session()
Base = declarative_base()

# ______________________________________________________________________

class Fxt_Settings(Base):
    __tablename__ = 'fxt_settings'

    id          = Column(Integer, primary_key=True)
    name        = Column(String(50), unique=True, nullable=False)
    active      = Column(Integer, nullable=False)
    sell_target = Column(Float, nullable=False)
    amount      = Column(Float, nullable=False)
    trail       = Column(Float, nullable=False)
    symbol      = Column(String(50))
    

    def __init__(self, name, active=0, sell_target=0.00, amount=0.00, trail=0.0):
        self.name        = name
        self.active      = active
        self.sell_target = sell_target
        self.amount      = amount
        self.trail       = trail
        self.symbol = os.getenv('SYMBOL1') + ' ' +os.getenv('SYMBOL2')

# ____________________

class Fxt_Current(Base):
    __tablename__ = 'fxt_current'

    id = Column(Integer, primary_key=True)    
    name = Column(String(50), unique=True)
    value = Column(String(50), unique=False)

    def __init__(self, name, value):
        self.name = name
        self.value = value
# ____________________

class Fxt_Error(Base):
    __tablename__ = 'fxt_error'

    id = Column(Integer, primary_key=True)

    timedate = Column(DateTime, default=func.now())
    error   = Column(Text)

    def __init__(self, error):
        self.error = error  

# ______________________________________________________________________
Base.metadata.create_all(engine)



