# 🎨 Fargevelger - fra Hex til RGB

Dette prosjektet består av to deler:
1. **FastAPI-backend** (`main.py`) 🛠️: API som konverterer HEX-fargekoder til RGB-verdier.  
2. **PyQt5 GUI-applikasjon** (`find_color.py`) Lar brukeren ta skjermbilder eller ~~åpne lokale bilder~~, klikke på en piksel for å hente fargen, og konvertere fra HEX til RGB ved hjelp av API-et.

---

## 📑 Innholdsfortegnelse

1. [🔧 Forutsetninger](#forutsetninger)  
2. [💾 Installasjon](#installasjon)  
3. [🚀 Starte backend-API-et](#starte-backend-api-et)  
4. [🖱️ Starte applikasjonen](#starte-applikasjonen)  

---

## 🔧 Forutsetninger

- **Python-versjon**: 3.7 eller nyere 🐍  
- **Avhengigheter**:
  - `fastapi`
  - `uvicorn`
  - `PyQt5`
  - `requests`

---

## 💾 Installasjon

1. **Klon repository’et**:
   ```bash
   git clone <repo-url>
   cd <repo-mappe>
   ```

2. **Installer avhengigheter**:
   ```bash
   pip install fastapi uvicorn PyQt5 requests
   ```

---

## 🚀 Starte backend-API-et

Kjør FastAPI-serveren for HEX-til-RGB-konvertering:

```bash
uvicorn main:app --reload
```

- **Base-URL**: `http://127.0.0.1:8000` 🌐

### 🛣️ Endepunkter

| Metode  | Endepunkt                                    | Beskrivelse                                                                       |
|:--------|:---------------------------------------------|:-----------------------------------------------------------------------------------|
| `GET`   | `/convert/hex-to-rgb?hex=<HEKSKODE>`         | Konverterer en 6-tegns HEX-streng (uten `#`) til RGB. Mottar som query-parameter.  |

**Parameter:**

- `hex` (streng): Seks tegn, f.eks. `FEFE00` som er gul.

> **Eksempel:**  
> `GET /convert/hex-to-rgb?hex=FEFE00`  
> **Svar:**
> ```json
> { "r": 254, "g": 254, "b": 0 }
> ```

---

## 🖱️ Starte applikasjonen

Kjør PyQt5-applikasjonen som kommuniserer med API-et:

```bash
python find_color.py
```

---

## 🖼️ Brukergrensesnitt

- **📸 Ta skjermbilde** (`snapshot_button`):  
  Tar et bilde av hele skjermen.

- ~~**📂 Hent et lokalt bilde** (`open_picture`):  
  Åpner en lokal bildefil.~~ (Funksjonalitet ikke lagt til ennå.)

- **🖼️ Bildevisning** (`image_label`):  
  Viser det valgte bildet eller skjermbildet. Klikk på bildet for å hente farge.

- **🎨 Fargeprøve** (`color_sample`):  
  Viser den valgte fargen i en boks.

- **🔢 HEX-etikett**:  
  Viser fargekoden i HEX-format.

- **🟥🟩🟦 RGB-etikett**:  
  Viser fargekoden i RGB-format etter konvertering fra API-et.

---