Správce výdajů

Tento projekt je webová aplikace pro správu osobního rozpočtu. 
Umožňuje uživatelům přidávat, aktualizovat a mazat výdaje, které jsou ukládány do databáze.

Funkce
Uživatel může přidat nový výdaj zadáním názvu rozpočtu a částky, upravit existující výdaj pomocí formuláře s předvyplněnými informacemi.
Dále může odstranit existující výdaj ze seznamu. Na hlavní stránce je zobrazena celková částka všech výdajů.
Po provedení akcí se zobrazí zpráva o úspěchu nebo chybě.

Použité technologie
Frontend: HTML, Bootstrap
Backend: PHP
Databáze: MySQL


Stáhněte projekt:

git clone https://github.com/Gardew/Rozpocet.git

Importujte databázi:

Vytvořte novou MySQL databázi s názvem rozpocetDB.
Importujte SQL skript rozpocetDB.sql do vaší databáze.

Konfigurace připojení k databázi:

Upravte soubor proces.php a změňte parametry připojení k databázi podle vašeho nastavení.
$pripojeni = new mysqli("localhost","root","","rozpocetDB");

