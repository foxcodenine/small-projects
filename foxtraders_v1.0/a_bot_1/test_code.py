order = {'fills': [
    {'price': '1.93110000', 'qty': '1485.04000000', 'commission': '0.00377481', 'commissionAsset': 'BNB', 'tradeId': 155208516},
    {'price': '1.93100000', 'qty': '1445.93000000', 'commission': '0.00367521', 'commissionAsset': 'BNB', 'tradeId': 155208517},
    {'price': '1.93090000', 'qty': '1075.60000000','commission': '0.00273378', 'commissionAsset': 'BNB', 'tradeId': 155208518},
    {'price': '1.93060000', 'qty': '33.43000000', 'commission': '0.00008495', 'commissionAsset': 'BNB', 'tradeId': 155208519}
]}

pprice = 0
qqty = 0

for f in order['fills']:
    pprice += float(f['price'])
    qqty += float(f['qty'])

pprice = pprice / len(order['fills'])

action = 'buy'


if action == 'sell':
    qqty = round(qqty * pprice * 0.99, 2) 
    # side = SIDE_BUY
    pprice = round(pprice * 0.75, 4)

else:
    # side = SIDE_SELL
    pprice = round(pprice * 1.25, 4)  


print(qqty, pprice)