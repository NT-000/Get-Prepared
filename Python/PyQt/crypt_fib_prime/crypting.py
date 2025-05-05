import sys
import requests
from urllib.parse import quote
from PyQt5.QtWidgets import QApplication, QLineEdit, QMainWindow, QPushButton, QLabel,QMessageBox
from PyQt5.QtGui import QIntValidator

class MainWindow(QMainWindow):
    def __init__(self):
        super().__init__()
        self.setWindowTitle("Vigenère Kryptering, nærmeste prim - og fibonacci-tall")
        self.setGeometry(1000, 100, 800, 1200)
        self.input = QLineEdit(self)
        self.ciphered_text = QLineEdit(self)
        self.key_input = QLineEdit(self)
        self.closest_prime_input = QLineEdit(self)
        self.closest_fibonacci_input = QLineEdit(self)

        self.button = QPushButton("Krypter", self)
        self.decrypt_button = QPushButton("Dekrypter", self)
        self.crack_button = QPushButton("Knekk koden", self)
        self.output_label = QLabel("Resultat:", self)
        self.result_label = QLabel("", self)

        self.initUI()

    def initUI(self):
        # input text to encrypt
        self.input.setGeometry(150, 100, 200, 50)
        self.input.setPlaceholderText("Skriv tekst her")
        self.input.setStyleSheet("font-size: 20px;")
        self.input.returnPressed.connect(self.encrypt_text)

        # label input
        input_label = QLabel("Tekst:", self)
        input_label.setGeometry(50, 110, 100, 30)
        input_label.setStyleSheet("font-size: 16px;")

        # label key
        key_label = QLabel("Nøkkel:", self)
        key_label.setGeometry(50, 170, 100, 30)
        key_label.setStyleSheet("font-size: 16px;")

        # textinput key
        self.key_input.setGeometry(150, 170, 200, 50)
        self.key_input.setPlaceholderText("Skriv nøkkel her")
        self.key_input.setStyleSheet("font-size: 20px;")

        # label crypt text label

        crypt_label = QLabel("Kryptert:", self)
        crypt_label.setGeometry(50, 250, 100, 30)
        crypt_label.setStyleSheet("font-size: 16px;")

        # crypt input
        self.ciphered_text.setStyleSheet("font-size: 20px;")
        self.ciphered_text.setPlaceholderText("Kryptert tekst vil bli vist her")
        self.ciphered_text.setGeometry(150, 240, 200, 50)


        #primenum label
        primenum_label = QLabel("Primtall:", self)
        primenum_label.setGeometry(400, 110, 100, 30)
        primenum_label.setStyleSheet("font-size: 16px;")

        # primenum input
        self.closest_prime_input.setValidator(QIntValidator())
        self.closest_prime_input.setGeometry(500, 100, 200, 50)
        self.closest_prime_input.setPlaceholderText("Finn nærmeste primtall")
        self.closest_prime_input.setStyleSheet("font-size: 20px;")
        self.closest_prime_input.returnPressed.connect(self.find_closest_prime)
        # set range later

        #fibonacci label
        fibonacci_label = QLabel("Fibonacci-tall:", self)
        fibonacci_label.setGeometry(400, 170, 110, 30)
        fibonacci_label.setStyleSheet("font-size: 16px;")

        #fibonacci input
        self.closest_fibonacci_input.setValidator(QIntValidator())
        self.closest_fibonacci_input.setGeometry(500, 170, 200, 50)
        self.closest_fibonacci_input.setPlaceholderText("Finn nærmeste fibonacci-tall")
        self.closest_fibonacci_input.setStyleSheet("font-size: 20px;")
        self.closest_fibonacci_input.returnPressed.connect(self.find_closest_fibonacci)
        #Set range

        # crypt-button
        self.button.setGeometry(100, 300, 150, 50)
        self.button.clicked.connect(self.encrypt_text)
        self.button.setStyleSheet("background-color: red; color: white; font-weight: bold;")

        # decrypt-button
        self.decrypt_button.setGeometry(270, 300, 150, 50)
        self.decrypt_button.clicked.connect(self.decrypt_text)
        self.decrypt_button.setStyleSheet("background-color: blue; color: white; font-weight: bold;")

        # crack-button
        self.crack_button.setGeometry(440, 300, 160, 50)
        self.crack_button.clicked.connect(self.crack_cipher)
        self.crack_button.setStyleSheet("background-color: yellow; color: black; font-weight: bold;")

        # label output
        self.output_label.setGeometry(50, 500, 400, 30)
        self.output_label.setStyleSheet("font-size: 16px;")

        # result
        self.result_label.setGeometry(50, 540, 700, 500)
        self.result_label.setStyleSheet(
            "font-size: 18px; background-color: #f0f0f0; padding: 10px; word-wrap: break-word;")
        self.result_label.setWordWrap(True)

    def find_closest_prime(self):
        number = int(self.closest_prime_input.text())

        if not number:
            self.show_error("Vennligst skriv inn et tall")
            return
        prime_response = requests.get(f"http://127.0.0.1:8000/primes/closest/{number}")
        prime_number = prime_response.json()["closest_prime"]
        self.result_label.setText(f"Nærmeste primtall til {number} er: {prime_number}")
        self.closest_prime_input.setText("")

    def find_closest_fibonacci(self):
        num = int(self.closest_fibonacci_input.text())

        if not num:
            self.show_error("Vennligst skriv inn et tall")
            return

        fibonacci_response = requests.get(f"http://127.0.0.1:8000/fibonacci/find_closest/{num}")
        fibonacci_number = fibonacci_response.json()["closest_fibonacci_number"]
        is_fibonacci = fibonacci_response.json()["is_fibonacci"]

        if is_fibonacci:
            self.result_label.setText(f"Tallet {num} er et fibonacci-tall")
        else:
            self.result_label.setText(f"Nærmeste fibonacci-tall til {num} er: {fibonacci_number}")

        self.closest_fibonacci_input.setText("")

    def encrypt_text(self):
        text = self.input.text()
        key = self.key_input.text()

        if not text:
            self.show_error("Vennligst skriv inn tekst å kryptere")
            return

        if not key:
            self.show_error("Vennligst skriv inn en nøkkel for kryptering")
            return

        if not key.isalpha():
            self.show_error("Nøkkelen kan bare inneholde bokstaver")
            return


        cipher_response = requests.get(f"http://127.0.0.1:8000/cipher?text={quote(text)}&key={quote(key)}",)

        ciphered_text = cipher_response.json()["ciphered_text"]
        self.result_label.setText(f"Kryptert tekst: {ciphered_text}")
        self.ciphered_text.setText(ciphered_text)
        self.input.setText("")
        self.key_input.setText("")



    def decrypt_text(self):
        text = self.input.text()
        key = self.key_input.text()

        if not text:
            self.show_error("Vennligst skriv inn tekst å dekryptere")
            return

        if not key:
            self.show_error("Vennligst skriv inn en nøkkel for dekryptering")
            return

        if not key.isalpha():
            self.show_error("Nøkkelen må bare inneholde bokstaver")
            return


        decipher_response = requests.get(f"http://127.0.0.1:8000/decipher?ciphered_text={quote(text)}&key={quote(key)}")
        decipher_response.raise_for_status()
        deciphered_text = decipher_response.json()["deciphered_text"]
        self.result_label.setText(f"Dekryptert tekst: {deciphered_text}")


    def crack_cipher(self):
        text = self.ciphered_text.text()

        if not text:
            self.show_error("Vennligst skriv inn kryptert tekst")
            return

        crack_response = requests.get(f"http://127.0.0.1:8000/crack?ciphered_text={quote(text)}")

        result = crack_response.json()

        if result:
            suggested_key = result.get("suggested_key", "")
            deciphered_text = result.get("deciphered_text", "")

            self.result_label.setText(
                f"Sannsynlig nøkkel: {suggested_key}\n"
                f"Nøkkellengde: {result.get('key_length', '')}\n\n"
                f"Dekryptert tekst:\n\n{deciphered_text}"
            )
            self.key_input.setText(suggested_key)
        else:
            self.result_label.setText(
                f"Kunne ikke knekke koden"
            )


    #error popup
    def show_error(self, message):
        error_dialog = QMessageBox(self)
        error_dialog.setWindowTitle("Noe gikk feil")
        error_dialog.setText(message)
        error_dialog.setStandardButtons(QMessageBox.Ok)
        error_dialog.exec_()
#add error-handling

if __name__ == "__main__":
    app = QApplication(sys.argv)
    window = MainWindow()
    window.show()
    sys.exit(app.exec_())
