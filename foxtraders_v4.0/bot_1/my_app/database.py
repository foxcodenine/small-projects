from my_app import app
from sqlalchemy import create_engine, Column, DateTime, String, Numeric, Integer, func, DECIMAL, Float, Text
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import sessionmaker



engine = create_engine(app.db_address)

Session = sessionmaker()
Session.configure(bind=engine)

# ______________________________________________________________________

Base = declarative_base()

class Fxt_Data(Base):
    __tablename__ = 'fxt_data'

    id = Column(Integer, primary_key=True)
    candle = Column(DateTime, default=func.now())
    price  = Column(Float, nullable=False)
    ema  = Column(Float, nullable=False)
    sma  = Column(Float, nullable=False)
    atr  = Column(Float, nullable=False)
    status = Column(String(50))

    def __init__(self, price, ema, sma, atr, status='null'):
        self.price = price
        self.ema = ema
        self.sma = sma
        self.atr = atr
        self.status = status

# ____________________


class Fxt_Action(Base):
    __tablename__ = 'fxt_action'

    id = Column(Integer, primary_key=True)

    timedate = Column(DateTime, default=func.now())
    action   = Column(String(255))
    price    = Column(Float, nullable=False)

    def __init__(self, action, price):
        self.action = action
        self.price  = price

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
    


