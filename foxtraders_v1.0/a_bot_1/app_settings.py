from run import *
from my_app.database import *

if __name__ == '__main__':

    p1      = Fxt_Settings('P1') 
    p2      = Fxt_Settings('P2') 
    p3      = Fxt_Settings('P3') 

    session.add(p1)
    session.add(p2)
    session.add(p3)

    session.commit() 