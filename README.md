# Project: Micro-eNurgy-PoC

**Status:** Voltooid (Volledige CRUD-implementatie)
**Gebouwd in:** 5 dagen

Een 'Proof of Concept' (POC) backend-applicatie, van de grond af opgebouwd in PHP & MySQL. Dit project is niet zomaar een 'read-only' site; het is een **volledig functionele, veilige, data-gedreven webapplicatie** die de volledige CRUD-levenscyclus demonstreert.

## Kernfunctionaliteit (Volledige CRUD)

Deze applicatie implementeert de vier fundamentele operaties van datamanagement. Een ingelogde gebruiker kan:

* **Create (Maken):** Nieuwe, eigen oefeningen aanmaken via een beveiligd formulier (`INSERT`).
* **Read (Lezen):** *Alleen* de oefeningen ophalen die aan hun eigen account zijn gekoppeld (`SELECT ... WHERE user_id = ?`).
* **Update (Bewerken):** Hun bestaande oefeningen bewerken via een voorgevuld formulier (`UPDATE`).
* **Delete (Verwijderen):** Hun eigen oefeningen veilig verwijderen (`DELETE`).

## Technische Specificaties & Beveiliging

Dit project is gebouwd met een 'security-first' mentaliteit, zonder frameworks.

### 1. Backend Logica (De Motor)

* **Taal:** PHP (procedureel)
* **Database:** MySQL
* **Architectuur:** Volledige implementatie van de **CRUD**-levenscyclus (`INSERT`, `SELECT`, `UPDATE`, `DELETE`).
* **Dataverbinding:** Uitsluitend gebruik van **PDO (PHP Data Objects)**.
* **Error Handling:** Robuuste `try...catch (PDOException)` blokken voor alle database-interacties.

### 2. Authenticatie & Autorisatie

* **Authenticatie:** Een complete login/logout-cyclus met **PHP Sessions** (`session_start()`, `$_SESSION`). De toegang tot de applicatie is volledig afgeschermd.
* **Autorisatie (Cruciaal):** Elke `SELECT`, `UPDATE`, en `DELETE` query is beveiligd. Acties worden *altijd* gecontroleerd op *eigenaarschap* (`... WHERE exercise_id = ? AND user_id = ?`). Dit voorkomt dat een ingelogde gebruiker de data van een andere gebruiker kan manipuleren.

### 3. Beveiliging (De Fortificatie)

* **SQL Injectie Preventie:** *Alle* database-queries (zonder uitzondering) maken gebruik van **Prepared Statements** (`prepare()` en `execute()`). Er wordt geen data direct in queries geplakt.
* **Wachtwoordbeveiliging:** Wachtwoorden worden gehasht met `password_hash()` (Bcrypt) en geverifieerd met `password_verify()`. Wachtwoorden in platte tekst bestaan niet in dit systeem.
* **Cross-Site Scripting (XSS) Preventie:** Alle data die vanuit de database naar de HTML wordt geschreven, wordt *altijd* geschoond met `htmlspecialchars()`.

## Hoe lokaal te draaien

1.  **Clone de repository:**
    ```bash
    git clone [https://github.com/Elvan-8/Micro-eNurgy-PoC.git](https://github.com/Elvan-8/Micro-eNurgy-PoC.git)
    ```
2.  **Importeer de database:**
    * Maak een nieuwe, lege MySQL-database aan.
    * Importeer het `schema.sql`-bestand in deze database. Dit creëert de tabellen en een testgebruiker:
        * **Gebruikersnaam:** `Test Gebruiker`
        * **Wachtwoord:** `test`
3.  **Configureer de verbinding:**
    * Open `connect.php`.
    * Pas de variabelen `$host`, `$db`, `$port`, `$user` en `$pass` aan zodat ze overeenkomen met jouw lokale database-instellingen.
4.  **Draai het project:**
    * Plaats de projectmap in de `htdocs`-map van je lokale server (MAMP/XAMPP).
    * Navigeer in je browser naar `http://localhost:[POORT]/[PROJECTMAP_NAAM]/` (bijv. `http://localhost:8888/Micro-eNurgy-PoC/`).