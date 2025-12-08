# All Roads Lead to Rome
# You are given a list with various flight connections in Europe. Each connection is represented as a tuple with the following elements:
#
# (city_from, city_to, time)
#
# For example, the following tuple represents a flight from Amsterdam to Dublin which takes 100 minutes:
#
# ('Amsterdam', 'Dublin', 100)
#
# Your task is to go through all the routes in a loop and check how many of them lead to Rome (i.e. how many of them have city_to equal to 'Rome'). Among the routes to Rome, you should also calculate the average flight time. Print the following the output:
#
# {} connections lead to Rome with an average flight time of {} minutes
#
# Replace {} with the number of connections and the average flight time.

connections = [
    ('Amsterdam', 'Dublin', 100),
    ('Amsterdam', 'Rome', 140),
    ('Rome', 'Warsaw', 130),
    ('Minsk', 'Prague', 95),
    ('Stockholm', 'Rome', 190),
    ('Copenhagen', 'Paris', 120),
    ('Madrid', 'Rome', 135),
    ('Lisbon', 'Rome', 170),
    ('Dublin', 'Rome', 170),
    ]

lead_to_rome = 0
total_airtime = 0

for flight in connections:
	if flight[1] == 'Rome':
		lead_to_rome += 1
		total_airtime += flight[2]
		print('Flight', flight[0], '-', flight[1])
print('Total airtime:', total_airtime / 5)
print(f"{lead_to_rome} connections lead to Rome with an average flight time of {total_airtime / lead_to_rome} minutes")