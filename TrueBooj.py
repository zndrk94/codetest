def truebooj(number):
	# To do the least amount of computing, find
	# the multiples that are most comment first.

	# Multiples of three is most common.
	if number%3 == 0:
		return "True"
	# Multiples of five is next.
	elif number%5 == 0:
		return "Booj"
	elif number%10 == 0:
		return "TrueBooj"
	# Multiples of ten is next.
	else:
		return str(number)
