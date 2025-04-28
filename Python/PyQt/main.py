import sys
from PyQt5.QtWidgets import QApplication, QMainWindow, QLabel
from PyQt5.QtGui import QIcon, QFont
from PyQt5.QtCore import Qt

class MainWindow(QMainWindow):
    def __init__(self):
        super().__init__()
        self.setWindowTitle("HEX to RGB")
        self.setGeometry(700, 300, 640, 480)
        self.setWindowIcon(QIcon("7d906f52-6af1-4dc5-9925-09cc726ecf0a_73f978ec-abe4-4aa0-981c-4e1281a030af.png"))

        label = QLabel("Hello World!", self)
        label.setGeometry(0, 0, 640, 100)
        label.setFont(QFont("Arial", 30))
        label.setStyleSheet("background-color: #000000; color: blue; font-weight: bold; font-size: 30px; font-style: italic;")
        label.setAlignment(Qt.AlignHCenter | Qt.AlignVCenter)

def main():
   app = QApplication(sys.argv)
   window = MainWindow()
   window.show()
   sys.exit(app.exec_())

if __name__ == "__main__":
   main()