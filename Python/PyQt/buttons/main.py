import sys
from PyQt5.QtWidgets import QApplication, QWidget, QMainWindow, QPushButton, QLabel


class MainWindow(QMainWindow):
    def __init__(self):
        super().__init__()
        self.setWindowTitle("PyQt Layout test")
        self.setGeometry(700, 300, 500, 500)
        self.button = QPushButton("Button", self)
        self.label = QLabel("Hello there!", self)
        self.init_ui()

    def init_ui(self):
        self.button.setGeometry(150, 200, 200, 100)
        self.button.setStyleSheet("background-color: red; font-size: 30px;")
        self.button.clicked.connect(self.on_click)

        self.label.setGeometry(150, 300, 200, 100)
        self.label.setStyleSheet("font-size: 30px;")

    def on_click(self):
        print("clicked")
        self.button.setText("Clicked!")
        self.button.setDisabled(True)
        self.label.setText("Bye!")


if __name__ == "__main__":
    app = QApplication(sys.argv)
    window = MainWindow()
    window.show()
    sys.exit(app.exec_())