import requests
from PyQt5.QtCore import Qt
from PyQt5.QtWidgets import QApplication, QMainWindow, QLabel, QHBoxLayout, QVBoxLayout, QWidget, QPushButton
from PyQt5.QtGui import QPixmap, QColor
import sys

class MainWindow(QMainWindow):
    def __init__(self):
        super().__init__()
        self.setWindowTitle("HEX-RGB Color test")
        self.setGeometry(700, 300, 500, 500)

        self.snapshot_button = QPushButton("Ta skjermbilde")
        self.open_picture = QPushButton("Hent et bilde lokalt")
        self.current_picture = None
        self.pixmap = None

        self.init_ui()


    def init_ui(self):
        central_widget = QWidget()
        self.setCentralWidget(central_widget)
        main_layout = QVBoxLayout(central_widget)

        #buttons layout
        button_layout = QHBoxLayout()
        button_layout.addWidget(self.snapshot_button)
        self.snapshot_button.clicked.connect(self.take_snapshot)
        button_layout.addWidget(self.open_picture)

        main_layout.addLayout(button_layout)

        #image window
        self.image_label = QLabel("Bildevisning")
        self.image_label.setScaledContents(True)
        self.image_label.setMinimumSize(400, 300)
        self.image_label.setAlignment(Qt.AlignCenter)
        self.image_label.mousePressEvent = self.find_pixel_color
        main_layout.addWidget(self.image_label)

        #convert HEX to RGB, sample box
        color_layout = QHBoxLayout()

        self.color_sample = QLabel("Fargevindu")
        self.color_sample.setStyleSheet("background-color: white; border: 1px solid black;")
        self.color_sample.setFixedSize(100, 100)
        self.color_sample.setAlignment(Qt.AlignCenter)
        color_layout.addWidget(self.color_sample)

        #HEX and RGB info layouts
        color_info_layout = QVBoxLayout()
        self.hex_label = QLabel("HEX: ")
        self.rgb_label = QLabel("RGB: ")
        color_info_layout.addWidget(self.hex_label)
        color_info_layout.addWidget(self.rgb_label)

        color_layout.addLayout(color_info_layout)
        main_layout.addLayout(color_layout)


    def take_snapshot(self):
        self.hide()
        screen = QApplication.primaryScreen()
        self.current_picture = screen.grabWindow(0)
        self.pixmap = self.current_picture.copy()
        self.show()
        self.picture_display()


    def picture_display(self):
        if self.pixmap:
            scaled_pixmap = self.pixmap.scaled(self.image_label.width(), self.image_label.height(),Qt.KeepAspectRatio)
            self.image_label.setPixmap(scaled_pixmap)
            self.current_picture = self.pixmap.toImage()

    def convert_hex_to_rgb(self, hex_code):

        hex_value = hex_code.lstrip('#')
        response = requests.get(f"http://127.0.0.1:8000/convert/hex-to-rgb?hex={hex_value}")

        rgb_data = response.json()
        r = rgb_data.get("r", 0)
        g = rgb_data.get("g", 0)
        b = rgb_data.get("b", 0)
        self.rgb_label.setText(f"RGB: ({r}, {g}, {b})")


    def find_pixel_color(self, event):
        if self.current_picture:
            label_width = self.image_label.width()
            label_height = self.image_label.height()

            pixmap_width = self.image_label.pixmap().width()
            pixmap_height = self.image_label.pixmap().height()

            x_offset = (label_width - pixmap_width) // 2
            y_offset = (label_height - pixmap_height) // 2

            x = event.pos().x() - x_offset
            y = event.pos().y() - y_offset

            if 0 <= x < pixmap_width and 0 <= y < pixmap_height:
                original_x = int(x * self.pixmap.width() / pixmap_width)
                original_y = int(y * self.pixmap.height() / pixmap_height)

            color = QColor(self.current_picture.pixel(original_x, original_y))
            self.display_color_found(color)

    def display_color_found(self, color):
        self.color_sample.setStyleSheet(f"background-color: {color.name()}; border: 1px solid black;")

        hex_code = color.name().upper()
        self.hex_label.setText(f"HEX: {hex_code}")

        self.convert_hex_to_rgb(hex_code)


def main():
    app = QApplication(sys.argv)
    window = MainWindow()
    window.show()
    sys.exit(app.exec_())


if __name__ == "__main__":
    main()
