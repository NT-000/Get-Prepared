import sys
from PyQt5.QtGui import QIcon
from PyQt5.QtWidgets import QApplication, QMainWindow, QCheckBox
from PyQt5.QtCore import Qt

class MainWindow(QMainWindow):
    def __init__(self):
        super().__init__()
        self.setWindowTitle("Checkbox Example")
        self.setGeometry(700, 300, 640, 480)
        self.checkbox = QCheckBox("Do you prefer dinner over breakfast?", self)

        self.initIU()

    def initIU(self):
        self.checkbox.setStyleSheet("font-size: 20px;")
        self.checkbox.setGeometry(0, 10, 200, 100)
        self.checkbox.setChecked(False)
        self.checkbox.stateChanged.connect(self.checkbox_checked)

    def checkbox_checked(self, state):

        if state == Qt.Checked:
            print("You prefer dinner")
        else:
            print("You prefer breakfast")



if __name__ == "__main__":
    app = QApplication(sys.argv)
    window = MainWindow()
    window.show()
    sys.exit(app.exec_())