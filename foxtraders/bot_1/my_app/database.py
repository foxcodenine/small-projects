from my_app import app
from sqlalchemy import create_engine, Column, DateTime, String, Numeric, Integer, func, DECIMAL, Float
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

    price = Column(Float, nullable=False)
    ema144 = Column(Float, nullable=False)
    sma36 = Column(Float, nullable=False)
    new =   Column(String(10))

    def __init__(self, price, ema144, sma36, new='False'):
        self.price = price
        self.ema144 = ema144
        self.sma36 = sma36
        self.new = new

# ______________________________________________________________________
Base.metadata.create_all(engine)
    


