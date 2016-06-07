# Efficiently finds the equilibrium of an array.
# Program runs in O(n*log(n))
def eqindex(data):
	# There's no avoiding at least itterating
	# through the array to get sums at least
	# once, so this sets the algorithm at O(n)
	
	# We need to find the sum of all bellow
	# the array.
	sums = []
	# Then find a total.
	total = 0
	# We'll use foreach because it's more 
	# efficient than for in range because
	# range would have to be indexed each time,
	# which would immidiately set the algorithm
	# at O(n^2) to index all of them.
	# This is more efficient.
	for item in data:
		total += item
		sums.append(total)
	# Half the sums. Now we need to see if
	# half tht total is somewhere in the
	# array. If so, that's the equilibrium
	# point.
	half = total/2
	# Binary search can find the value
	# in O(log(n)) time complexity.
	return binarySearch(sums, half)


# Binary search returns index of needle if found
# and -1 otherwise.
# Simple binary search for array, runs in O(log(n))
def binarySearch(haystack, needle):
        first = 0
	# Originaally, I thought len() would set the
	# time complexity to O(n), but as it turns
	# out, len() runs in O(1) per the python
	# time complexity spec:
	# https://www.ics.uci.edu/~pattis/ICS-33/lectures/complexitypython.txt
        last = len(haystack) - 1 
        index = 0
        found = False
	# We could have used recursion, but this 
	# less heavy on the stack and is probably
	# faster (Although I haven't tested it).
        while (first<=last) and (found!=True):
                index = (first + last)//2
                if haystack[index] == needle:
                        found = True
			break
                else:
                        if needle < haystack[index]:
                                last = index-1
                        else:
                                first = index+1
        if found==True:
                return index
        else:
		# Return an negative index if
		# the needle isn't found.
                return -1

