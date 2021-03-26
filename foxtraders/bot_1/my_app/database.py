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
    new =   Column(String(10), default='False')


# ______________________________________________________________________
Base.metadata.create_all(engine)
    


