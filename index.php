<?php

/**
 * Commencez par importer le fichier sql live.sql via PHPMyAdmin.
 * 1. Sélectionnez tous les utilisateurs.
 * 2. Sélectionnez tous les articles.
 * 3. Sélectionnez tous les utilisateurs qui parlent de poterie dans un article.
 * 4. Sélectionnez tous les utilisateurs ayant au moins écrit deux articles.
 * 5. Sélectionnez l'utilisateur Jane uniquement s'il elle a écris un article ( le résultat devrait être vide ! ).
 *
 * ( PS: Sélectionnez, mais affichez le résultat à chaque fois ! ).
 */



require "DbPDO.php";
DbPDO::connect();

// 1
DbPDO::oneExo();
// 2
DbPDO::twoExo();
// 3
DbPDO::threeExo();
// 4
DbPDO::fourExo();
// 5
DbPDO::fiveExo();