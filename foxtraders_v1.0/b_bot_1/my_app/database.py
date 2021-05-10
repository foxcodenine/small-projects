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

    id = Column(Integer, primary_key=True)
    name = Column(String(50), unique=True)
    value = Column(String(50))
    info = Column(String(255))

    def __init__(self, name, value, info=None):
        self.name = name
        self.value = value
        self.info = info
# ______________________________________________________________________


class Fxt_Parameters(Base):
    __tablename__ = 'fxt_parameters'

    id = Column(Integer, primary_key=True)
    name = Column(String(50), unique=False)
    value = Column(String(50))
    info = Column(String(255))

    def __init__(self, name, value, info=None):
        self.name = name
        self.value = value
        self.info = info

# ______________________________________________________________________

class Fxt_Action(Base):
    __tablename__ = 'fxt_action'

    id = Column(Integer, primary_key=True)   
    timedate = Column(DateTime, default=func.now()) 
    action = Column(Text, unique=False)

    def __init__(self, action):
        self.action = action

# ______________________________________________________________________

class Fxt_Error(Base):
    __tablename__ = 'fxt_error'

    id = Column(Integer, primary_key=True)
    timedate = Column(DateTime, default=func.now())
    error   = Column(Text)

    def __init__(self, error):
        self.error = error  

# ______________________________________________________________________