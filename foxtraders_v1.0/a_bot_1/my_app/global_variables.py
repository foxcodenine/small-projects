import os
# ______________________________________________________________________

app_mode        = os.getenv('MODE').lower()

symbol1         = os.getenv('SYMBOL1')
symbol2         = os.getenv('SYMBOL2')
symbol          = symbol1 + symbol2

restart_time    = int(os.getenv('RESTART_TIME'))

cur_close       = 0
cur_atl         = None
cur_ath         = None

cur_timestamp      = ''

# ______________________________________________________________________

class Postion():

    def __init__(self, name):

        self.name = name
        self.active = False
        self.amount = 0 
        self.sell_target = 0
        self.sell_trail = 0
        self.buy_target = 0
        self.buy_trail = 0
        self.target_reached = False
        self.counterorder = False


p_1 = Postion('P1')
p_2 = Postion('P2')
p_3 = Postion('P3')
p_4 = Postion('P4')
p_5 = Postion('P5')

# ______________________________________________________________________



