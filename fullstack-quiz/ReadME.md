# ❓ Wannabe Kahoot

Dette er et Kahoot-inspirert quizspill hvor du kan spille som innlogget bruker eller som gjest. Du kan velge mellom
forskjellige spilltyper (kort, medium, lang), svare på spørsmål, og kjempe om plass på topplisten.

---

## 📑Innholdsfortegnelse

- [Krav](#krav)
- [Installasjon](#installasjon)
- [Koble til DB](#kobling-til-database)
- [Bruk](#bruk)
- [Endepunkter](#endepunkter)
- [Eksempler](#eksempler)

---

## 🔧Krav

**Frontend:**

- `Svelte 4/5`
- `Vite`
- `nouislider (slider-komponent for UI)`
- `Node.js`

**Backend:**

- `Python 3.10+`
- `Flask`
- `Flask-Login(autentisering)`
- `PyMongo (MongoDB database)`
- `MongoDB(database)`

## 📦Installasjon

### Frontend

1. Gå til frontend-mappen:
    ```bash
    cd frontend
    ```
2. Installer nødvendige pakker:
    ```bash
    npm install
    ```

---

### Backend

1. Gå til backend-mappen:
    ```bash
    cd backend
    ```
2. Opprett og aktiver virtuelt miljø:
    ```bash
    python -m venv venv

    venv\Scripts\activate
    ```
3. Installer Python-avhengigheter:
    ```bash
    pip install -r requirements.txt
    ```

---

### 🗄️Kobling til database

1. **Opprett `.env`-fil i backend-mappen.**

Opprett en fil som heter `.env` i prosjektets `backend`-mappe med følgende innhold:

```env
MONGODB_URI="din_mongodb_uri"
SECRET_KEY="din_hemmelige_key"
```

**Eksempel:**

`MONGODB_URI="mongodb+srv://<bruker>:<passord>@<cluster>.mongodb.net/?retryWrites=true&w=majority"`

**2.Installer miljøvariabler**

```bash
    pip install python-dotenv
```

*Det er lagt ved testdata for poengsummer i mappen dummy_data (`scores_data.json`)

---

## 🔌Endepunkter

| Metode | Endepunkt                      | Beskrivelse                                      |
|--------|--------------------------------|--------------------------------------------------|
| POST   | `/api/login`                   | Logger inn bruker                                |
| POST   | `/api/login_guest`             | Logger inn som gjest                             |
| GET    | `/api/logged_in_user`          | Henter info om innlogget bruker                  |
| POST   | `/api/logout`                  | Logger ut bruker                                 |
| POST   | `/api/users`                   | Oppretter ny bruker                              |
| GET    | `/api/users`                   | Henter alle brukere                              |
| GET    | `/api/check_user?username=...` | Sjekker om brukernavn er i bruk                  |
| GET    | `/api/questions/<collection>`  | Henter spørsmål fra valgt collection             |
| GET    | `/api/questions`               | Henter alle spørsmål                             |
| POST   | `/api/questions/filtered`      | Filtrerer spørsmål (kategori, vanskelighetsgrad) |
| GET    | `/api/scores`                  | Henter alle poengsummer, sortert                 |
| POST   | `/api/scores`                  | Lagrer score for innlogget bruker                |
| DELETE | `/api/scores`                  | Sletter alle poengsummer                         |
| GET    | `/api/time`                    | Henter nedtellingstid                            |
| PUT    | `/api/time`                    | Oppdaterer nedtellingstid                        |

---

## 🧩Eksempler

### 1. Opprett bruker og logg inn

- Gå til registreringssiden.
- Fyll inn brukernavn, navn og passord.
- Klikk "Opprett bruker".
- Logg deretter inn med brukernavn og passord.

### 2. Spill som gjest

- Logg inn som gjest hvis du ikke vil opprette konto.
- Spill quiz uten å lagre personlig data.

### 3. Spill quiz

- Velg ønsket quiz-kategori og vanskelighetsgrad (valgfritt).
- Start quizen.
- Svar på spørsmålene som vises.
- Se hvor mange riktige svar du fikk etter endt quiz.

### 4. Se highscores

- Gå til "Highscores" eller "Resultater".
- Se poengsummen din og sammenlign deg med andre brukere.

## [Tilbake til toppen](#krav) ⬆️ ##
