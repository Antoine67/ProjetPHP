const express  = require('express');
const mysql    = require('mysql');
const jwt      = require('jsonwebtoken');
var bodyParser = require("body-parser");

const app = express();
app.use(bodyParser.urlencoded({extended :true}))

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX GET XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


app.get('/', (req,res)=> {
   res.send('Acceuil');
});



app.get('/api/utilisateurs', (req,res)=>{
   const connection = mysql.createConnection({
      host:'localhost',
      user:'root',
      database: 'projetphp_utilisateurs',
   });

   var cookie = lireCookie(req);
   console.log(cookie);

   var error = 0;

   // Vérification du token, validité et expiration 

   jwt.verify(cookie, 'secretkey', (err) =>{
      if(err){
         res.status(403).send('token erroné ou expiré');

         error=1;
      } 
   });

   if (error) return;
   
// Affiche les données de tous les utilisateurs 

   connection.query("SELECT * FROM utilisateurs", (err, rows, fields) =>{
    res.json(rows);
   });

});




app.get('/api/utilisateurs/:ID', (req,res)=>{
   const connection = mysql.createConnection({
      host:'localhost',
      user:'root',
      database: 'projetphp_utilisateurs',
   });

   var cookie = lireCookie(req);
   console.log(cookie);

   var error=0;

   // Vérification du token, validité et expiration 

   jwt.verify(cookie, 'secretkey', (err) =>{
      if(err){
         res.status(403).send('token erroné ou expiré');

         error=1;
      } 
   });

   if(error) return;
   
   // Affiche les données d'un utilisateur via son Id

   const userId = req.params.ID
   var queryString = "SELECT * FROM utilisateurs WHERE ID = ?";
   connection.query(queryString, [userId],(err, rows, fields) => {

      // Vérification de l'existance de l'utilisateur à afficher

      if(rows.length <= 0){
         res.status(404);
         res.json("l'utilisateur n'existe pas");
      }else{
         var queryString = "SELECT * FROM utilisateurs WHERE ID = ?"
         connection.query(queryString, [userId],(err, rows, fields) => {
            res.json(rows);
         });
      }
   });

});



// XXXXXXXXXXXXXXXXXXXXX POST XXXXXXXXXXXXXXXXXXXXXXXXX


app.post('/api/login', (req,res) =>{
   const connection = mysql.createConnection({
      host:'localhost',
      user:'root',
      database: 'projetphp_utilisateurs'
   });

   var identif = req.body.identifiant;
   var mdp = req.body.mdp;

   console.log(identif);
   console.log(mdp);
   
   
   var queryString = "SELECT * FROM utilisateurs WHERE Identifiant = ? AND Mot_de_passe = ?"
   connection.query(queryString, [identif,mdp], (err, rows, fields) => {
         console.log(rows);

      // Vérification de l'existance de l'utilisateur

      if(rows.length == 0){
        res.status(200).send("L'utilisateur n'existe pas");
   }else{   

      // Création du Token
     
      jwt.sign({rows}, 'secretkey', {expiresIn: '60*60*24*2'}, (err,token) => {
      
         // Création d'un cookie contenant le token

         res.writeHead(200, {
            'Set-Cookie': 'token_cookie_bde='+ token,
            'Content-Type': 'text/plain',
          });
         res.end('Cookie créé');
      });
       }

   });
})


// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX PUT XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


app.put('/api/utilisateurs/:ID', (req,res,next)=>{
   const connection = mysql.createConnection({
      host:'localhost',
      user:'root',
      database: 'projetphp_utilisateurs'
   });

   var cookie = lireCookie(req);

   error = 0;

   // Vérification du token, validité et expiration 

   jwt.verify(cookie, 'secretkey', (err) =>{
      if(err){
         res.status(403).send('token erroné ou expiré');

         error=1;
      } 
   });
   
   if(error) return;

   const userId = req.params.ID
   var queryString = "SELECT * FROM utilisateurs WHERE ID = ?"
   connection.query(queryString, [userId],(err, rows, fields) => {

      // Vérification de l'existance de l'utilisateur à modifier

      if(rows.length <= 0){
         res.status(404);
         res.json("l'utilisateur n'existe pas");
      }else{

   // Modification des données de l'utilisateur sélectionné 

   const prenom = req.body.Prenom;
   const nom = req.body.Nom;
   const email = req.body.Email;
   const localisation = req.body.Localisation;
   const mdp = req.body.Mdp;
   const role = req.body.Role;
   const identifiant = req.body.Identifiant;
   var queryString = 'UPDATE utilisateurs '
   +'SET '
   +'`Prenom` = "'+ prenom + '",'
   +'`Nom` = "'+ nom + '",'
   +'`Email` = "'+ email + '",'
   +'`Localisation` = "' + localisation + '",'
   +'`Mot_de_passe` = "' + mdp + '",'
   +'`Identifiant` = "' + identifiant + '",'
   +'`Role`=' + role + ' '
   +'WHERE `ID`= ' + userId
   connection.query(queryString, [userId],(err, rows, fields) => {
      
      console.log(err);
      console.log("updated");
      res.status(200);
      res.json("Mise à jour reussie");

   });
         
      } 
   });

});



// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX DELETE XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


app.delete('/api/utilisateurs/:ID', (req,res,next)=>{
   const connection = mysql.createConnection({
      host:'localhost',
      user:'root',
      database: 'projetphp_utilisateurs'
   });
   var cookie = lireCookie(req);
   error = 0;

   // Vérification du token, validité et expiration 

   jwt.verify(cookie, 'secretkey', (err) =>{
      if(err){
         res.status(403).send('token erroné ou expiré');
         error=1;
      } 
   });

   if(error) return;

   const userId = req.params.ID
   var queryString = "SELECT * FROM utilisateurs WHERE ID = ?"
   connection.query(queryString, [userId],(err, rows, fields) => {

      // Vérification de l'existance de l'utilisateur à supprimer

      if(rows.length <= 0){
         res.status(404);
         res.json("l'utilisateur n'existe pas");
      }else{

         // Suppression de l'utilisateur sélectionné

         var queryString2 = "DELETE FROM utilisateurs WHERE ID = ?"
         connection.query(queryString2, [userId],(err, rows, fields) => {
            console.log(userId);
            res.status(200);
            res.json("Suppression reussie");
         });
      } 
   });

});





//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX COOKIE XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

//Fonction de lecture du cookie

function lireCookie (request) {
   var list = {},
       rc = request.headers.cookie;

   rc && rc.split(';').forEach(function( cookie ) {
       var parts = cookie.split('=');
       list[parts.shift().trim()] = decodeURI(parts.join('='));
   });
   var cookiebde= list['token_cookie_bde'];
   console.log(cookiebde);
   return cookiebde;

}






app.listen(3000, () => console.log('listening on port 3000'));