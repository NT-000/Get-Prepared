days_since_purchase = int(input('How many days ago have you purchased the item? '))
used_item = input('Have you used the item at all [y/n]? ')
broke_down_on_its_own = input('Has the item broken down on its own [y/n]? ')

if broke_down_on_its_own == 'n' or days_since_purchase < 10 and used_item == 'n':
    print('You can get a refund.')
else:
    print('You cannot get a refund.')