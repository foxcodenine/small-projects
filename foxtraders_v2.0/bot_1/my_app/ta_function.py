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
