import numpy as np
# ______________________________________________________________________
def exp_moving_average_list (data, window):

    sma = sum(data[0: window]) / window
    previous_ema = None

    multiplier = (2 / (window + 1))
    emas = []

    data = data[window: ]   

    for d in data:
        if not previous_ema:
            previous_ema = sma

        c_ema = (d - previous_ema) * multiplier + previous_ema
        previous_ema = c_ema

        emas.append(c_ema)

    return np.array(emas)

# ______________________________________________________________________
def simple_moving_avrage_list(values, window):
    weights = np.repeat(1.0, window) / window
    smas = np.convolve(values, weights, 'valid')
    return smas


# ______________________________________________________________________


def current_ema(current, previous_ema, window):
    
    
    multiplier = (2 / (window + 1))
    

    return (current - previous_ema) * multiplier + previous_ema 


# ______________________________________________________________________

def current_sma(data, window):
    data = data[(window * -1) : ]
    sma = sum(data) / window

    return sma
# ______________________________________________________________________


def true_range(pre_close, pre_low, pre_high, cur_close, cur_low, cur_high):

    tr = max(
        abs(cur_high - pre_close),
        abs(cur_low -  pre_close),        
        abs(cur_high - cur_low)
    )
    return tr


def average_true_range_list(closes_list, lows_list, highs_list, window):

    tr_list = []
    prior_atr = None
    atr_list = []    

    for i in range(window):

        pre_close = closes_list[i]
        cur_close = closes_list[i+1]

        pre_low   = lows_list[i]
        cur_low   = lows_list[i+1]

        pre_high  = highs_list[i]
        cur_high  = highs_list[i+1]

        cur_tr = true_range(pre_close, pre_low, pre_high, cur_close, cur_low, cur_high)

        tr_list.append(cur_tr)

    prior_atr = sum(tr_list) / window
    closes_list = closes_list[window :]
    lows_list   = lows_list[window :]
    highs_list  = highs_list[window :]

    r = len(closes_list) - 1

    for i in range(r):
        pre_close = closes_list[i]
        cur_close = closes_list[i+1]

        pre_low   = lows_list[i]
        cur_low   = lows_list[i+1]

        pre_high  = highs_list[i]
        cur_high  = highs_list[i+1]

        cur_tr = true_range(pre_close, pre_low, pre_high, cur_close, cur_low, cur_high) 

        cur_atr = ((prior_atr * (window-1)) + cur_tr) / window
        prior_atr = cur_atr


        atr_list.append(cur_atr)

    return atr_list


def average_true_range(pre_close, pre_low, pre_high, cur_close, cur_low, cur_high, prior_atr, window):
    cur_tr = true_range(pre_close, pre_low, pre_high, cur_close, cur_low, cur_high)
    cur_atr = ((prior_atr * (window-1)) + cur_tr) / window

    return cur_atr

