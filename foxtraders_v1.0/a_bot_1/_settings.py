from run import *
from my_app.database import *
import os 

if __name__ == '__main__':
        
    try:
        Fxt_Settings.__table__.drop(engine)
        Fxt_Parameters.__table__.drop(engine)
        Fxt_Error.__table__.drop(engine)
        Fxt_Action.__table__.drop(engine)

        session.commit()
        
    except:
        pass

    Base.metadata.create_all(engine)
    
    # __________________________________________________________________

    mode         = Fxt_Settings('mode', os.getenv('MODE'), '')        
    symbol1      = Fxt_Settings('symbol1', os.getenv('SYMBOL1'), 'Crypto to Buy')
    symbol2      = Fxt_Settings('symbol2', os.getenv('SYMBOL2'),'Base Currency') 
    restart_time = Fxt_Settings('restart_time', os.getenv('RESTART_TIME'),'time in seconds')

    session.add(mode)
    session.add(symbol1)
    session.add(symbol2)
    session.add(restart_time)

    session.commit()

    # __________________________________________________________________

    p1 = Fxt_Parameters('P1') 
    p2 = Fxt_Parameters('P2') 
    p3 = Fxt_Parameters('P3') 
    p4 = Fxt_Parameters('P4') 
    p5 = Fxt_Parameters('P5') 

    session.add(p1)
    session.add(p2)
    session.add(p3)
    session.add(p4)
    session.add(p5)

    session.commit() 
    # __________________________________________________________________