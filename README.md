# Project: Micro-eNurgy-PoC

Een Proof of Concept (POC) back-end applicatie, gebouwd in 10 dagen. Dit project demonstreert de kernlogica voor het ophalen van gebruikersspecifieke data uit een relationele database.

## Kernfunctionaliteit

Het hoofddoel van dit project is bereikt:
Een PHP-script (`index.php`) simuleert een ingelogde gebruiker (hardcoded `user_id = 1`) en haalt *alleen* de data (oefeningen) op die aan die specifieke gebruiker toebehoren. Data van andere gebruikers wordt correct genegeerd.

## Technische Specificaties

* **Talen:** PHP (from scratch), SQL
* **Database:** MySQL
* **Server Stack:** Apache (via MAMP)
* **Kern-concepten:**
    * **PDO (PHP Data Objects):** Voor de databaseverbinding.
    * **Prepared Statements:** Ter preventie van SQL Injectie-aanvallen.
    * **Foreign Key Constraints:** Om de referentiële integriteit tussen `users` en `excercises` te garanderen.
    * **SQL JOIN:** Om data uit beide tabellen efficiënt te koppelen.
    * **HTML Escaping:** Gebruik van `htmlspecialchars()` ter preventie van XSS-aanvallen op de frontend.

## Hoe lokaal te draaien

Om dit project lokaal te testen:

1.  **Clone de repository:**
    ```bash
    git clone [https://github.com/Elvan-8/Micro-eNurgy-PoC.git](https://github.com/Elvan-8/Micro-eNurgy-PoC.git)
    ```
2.  **Importeer de database:**
    * Maak een nieuwe, lege MySQL-database aan (bijv. `test_db`).
    * Importeer het `schema.sql`-bestand in deze nieuwe database. Dit creëert de `users` en `excercises` tabellen en voegt de dummy data toe.
3.  **Configureer de verbinding:**
    * Open `connect.php`.
    * Pas de variabelen `$host`, `$db`, `$port`, `$user` en `$pass` aan zodat ze overeenkomen met jouw lokale database-instellingen.
4.  **Draai het project:**
    * Plaats de projectmap in de `htdocs`-map van je lokale server (MAMP/XAMPP).
    * Navigeer in je browser naar `http://localhost:[POORT]/Micro-eNurgy-PoC/` (of hoe je de map ook noemt).
