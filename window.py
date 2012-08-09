#!/bin/env python
import sys
from PyQt4.QtCore import *
from PyQt4.QtGui import *
class MainWindow(QMainWindow):
	def __init__(self):
		super(MainWindow,self).__init__()
		self.initUi()
		self.setWindowState(Qt.WindowMaximized)
	def initUi(self):
		menuBar=self.menuBar()
		fileMenu=menuBar.addMenu('&File')

		exitAction=QAction("&Exit",self)
		exitAction.setShortcut("Alt+F4")
		exitAction.setStatusTip("exit composer")
		exitAction.triggered.connect(qApp.quit)

		fileMenu.addAction(exitAction)

		self.statusBar().showMessage("status")
		
		self.setGeometry(300,300,250,150)
		self.setWindowTitle("Music composer")
def run():
	app=QApplication(sys.argv)
	ex=MainWindow()
	ex.show()
	sys.exit(app.exec_())

if __name__=='__main__':
	run()

