import numpy as np

# https://school.stockcharts.com/doku.php?id=technical_indicators:moving_averages
my_data_2 = [22.27, 22.19,22.08,22.17,22.18,22.13,22.23,22.43,22.24,22.29,22.15,22.39,22.38,22.61,23.36,24.05,23.75,23.83,23.95,23.63,23.82,23.87,23.65,23.19,23.1,23.33,22.68,23.1,22.4,22.17,22.27, 22.19,22.08,22.17,22.18,22.13,22.23,22.43,22.24,22.29,22.15,22.39,22.38,22.61,23.36,24.05,23.75,23.83,23.95,23.63,23.82,23.87,23.65,23.19,23.1,23.33,22.68,23.1,22.4,22.17]
my_data_1 = [22.27, 22.19,22.08,22.17,22.18,22.13,22.23,22.43,22.24,22.29,22.15,22.39,22.38,22.61,23.36,24.05,23.75,23.83,23.95,23.63,23.82,23.87,23.65,23.19,23.1,23.33,22.68,23.1,22.4,22.17]

my_data_3 = [1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0]

# ______________________________________________________________________

def simple_moving_avrage_list(values, window):
    weights = np.repeat(1.0, window) / window
    smas = np.convolve(values, weights, 'valid')
    return smas
# ______________________________________________________________________

def exp_moving_average_list(values, window):
    weights = np.exp(np.linspace(+1., 0., window))
    weights /= weights.sum()

    emas = np.convolve(values, weights) [:len(values)]
    emas[:window]=emas[window]
    return emas
# ______________________________________________________________________

def my_ema_list (data, window):

    # Accuret data after (2 to 4 x window)

    sma = sum(data[0: window]) / window
    p_ema = None

    multiplier = (2 / (window + 1))
    ema = []

    data = data[window: ]   

    for d in data:

        if not p_ema:
            p_ema = sma

        c_ema = (d - p_ema) * multiplier + p_ema
        p_ema = c_ema

        ema.append(round(c_ema, 2))

    return(ema)
# ______________________________________________________________________


def lll(i='_'):
    print(f'\n({i}) ----------------------------------------------- \n')



lll('A') # -------------------------------------------------------------

print(my_ema_list(my_data_1, 10))

lll('B') # -------------------------------------------------------------

print(my_ema_list(my_data_2, 10))

lll('C') # -------------------------------------------------------------

cc = exp_moving_average_list(my_data_2, 10)
print(cc)

lll('D') # -------------------------------------------------------------

print(my_ema_list(my_data_3, 5))


