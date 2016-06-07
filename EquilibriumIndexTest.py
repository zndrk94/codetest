from EquilibriumIndex import eqindex

d = ([-7, 1, 5, 2, -4, 3, 0],
	[2, 4, 6],
	[2, 9, 2],
	[1, -1, 1, -1, 1, -1, 1])
 
for data in d:
	print("Original Array: %r" % data)
	print("Equilibrium Index: %r" % eqindex(data))
