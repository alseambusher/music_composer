#!/bin/env python
import os
import sys
import window
def main():
	if sys.path.count(os.getcwd()) == 0:
		sys.path.append(os.getcwd())
	local_dir=os.path.join(os.path.expanduser("~"),".composer")
	db_file=os.path.join(local_dir,"composer.sqlite")
	if not os.path.isdir(local_dir):
		os.mkdir(local_dir)
	if not os.path.exists(db_file):
		open(db_file,'w+')
	#also set resources
	window.run()
	

if __name__ == '__main__':
	main()

