# 🛡️ Vigenère-kryptering og tallanalyse

*Et skrivebordsprogram som lar deg kryptere og dekryptere tekst med Vigenère-chiffer, knekke ukjente nøkler ved hjelp av frekvensanalyse, og finne nærmeste primtall og Fibonacci-tall.*

---

## 📑Innholdsfortegnelse

- [Forutsetninger](#forutsetninger)
- [Installasjon](#installasjon)
- [Bruk](#bruk)
- [Endepunkter](#endepunkter)
- [Eksempler](#eksempler)

---

## 🔧Forutsetninger

**Frontend:**
- Python 3.7 eller nyere.
- `PyQt5`
- `requests`

**Backend:**
- `fastapi`
- `uvicorn`

Installer avhengigheter:
```bash
pip install PyQt5 fastapi uvicorn requests
```
---

## 🚀Installasjon

1. Start backend:
```bash
uvicorn main:app --reload
```

2. Start frontend-app:
```bash
python crypting.py
```

---

## 📋Bruk

Applikasjonen gir deg mulighet til å:

- Kryptere tekst med Vigenère-chiffer
- Dekryptere tekst med nøkkel
- Knekke chiffer uten nøkkel (frekvensanalyse)
- Finne nærmeste primtall
- Finne nærmeste Fibonacci-tall

---

## 🔌Endepunkter

| Metode | Endepunkt                            | Beskrivelse |
|--------|---------------------------------------|-------------|
| GET    | `/cipher?text=...&key=...`            | Krypterer tekst med Vigenère |
| GET    | `/decipher?ciphered_text=...&key=...` | Dekrypterer tekst |
| GET    | `/crack?ciphered_text=...`            | Knekker kryptert tekst |
| GET    | `/primes/closest/{number}`            | Finner nærmeste primtall |
| GET    | `/fibonacci/find_closest/{num}`       | Finner nærmeste Fibonacci-tall |

---

## 🧩Eksempler

Konverteringstabell for det engelske alfabetet \
![image](https://github.com/user-attachments/assets/57a1b8da-0d57-42c1-8c60-49c53a19b2b2)


**🔐Kryptering:**
```
GET /cipher?text=HELLO&key=KEY
Svar: { "ciphered_text": "RIJVS" }
```

1.Det skrives inn en tekst, feks "HELLO". \
2.Det skrives inn en nøkkel, feks "KEY" \
3.For hvert tegn i teksten, forskyves tegnet et visst antall plasser basert på tilsvarende tegn i nøkkelen.

H+K = H forskyves 10 plasser -> R \
E+E = H forskyves 4 plasser -> I \
L+Y = H forskyves 10 plasser -> J \
L+K = H forskyves 10 plasser -> V \
O+E = H forskyves 4 plasser -> S

Tekst: HELLO \
Nøkkel: KEY \
Kryptert tekst: RIJVS \

**🔓 Dekryptering:**
```
GET /decipher?ciphered_text=RIJVS&key=KEY
Svar: { "deciphered_text": "HELLO" }
```
Hvis man tar utgangspunkt i krypteringen over. \
1.Den krypterte teksten er: "RIJVS" \
2.Nøkkelen er: "KEY" \
3.For hvert tall i den krypterte teksten, flytter man det tilbake i alfabetet samme antall plasser.

R-K = R flyttes 10 plasser tilbake -> H \
I-E = I flyttes 4 plasser tilbake -> E \
J-Y = K flyttes 24 plasser tilbake -> L \
V-K = V flyttes 10 plasser tilbake -> L \
S-E = S flyttes 4 plasser tilbake -> O \


**![icons8-breaking-51](https://github.com/user-attachments/assets/43df182d-fcd4-41bc-8009-045afa2de698)
Kode-Knekking:**
```
GET /crack?ciphered_text={kryptert_tekst}
Svar: { "suggested_key": "Foreslått_nøkkel", "deciphered_text": "Originaltekst" }
```
1.Frekvensanalyse - basert på forekomsten av frekvensen av bokstaver i gitt språk, i denne appen, engelsk - de vanligste bokstavene er: ETAOIN. \
2.Gjenkjenning av mønster - Programmet analyserer den krypterte teksten og letter etter mønstre. \
3.Nøkkellengde - Programmet prøver først å finne ut av hvor lang nøkkelen er. \
4.Bokstaver i nøkkel - Deretter forsøker den å gjette hver enkelt-bokstav i nøkkelen. \

*PS. Knekking av kode uten nøkkel forutsetter tekstlengde på min 100 bokstaver +, jo lenger tekst jo bedre - jo lenger nøkkel desto vanskeligere å knekke koden. \
Hvis du vil prøve har jeg lagt ved sample.txt som består av tekster på ulike lengder.*

**3️⃣✨5️⃣✨7️⃣✨ Primtall:**
```
GET /primes/closest/50
Svar: { "closest_prime": 47 }
```
Bruker "Erathosthenes Sil" som er en metode for å finne primtall. \
1.Starter med en liste der alle i utgangspunktet antas å være primtall. \
2.Den begynner med 2 og markerer multipler av 2 (4,6,8 osv), altså tall som ikke er primtall. +
3.Så går den til neste tall som ikke er markert 3 og markerer alle multipler (6,9,12 osv) helt til alle primtall innenfor området er funnet.

**꩜ Fibonacci:**
```
GET /fibonacci/find_closest/21
Svar: { "is_fibonacci": true, "closest_fibonacci_number": 21 }
```
---
Den lagrer de to foregående tallene helt til den når et tall høyere enn input, for så å finne nærmeste fibonacci-tall til input. 

