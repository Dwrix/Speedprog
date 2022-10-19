const mariadb = require('mariadb');
const pool = mariadb.createPool({
    host:'localhost',
    user:'root',
    password:'root',
    database:'speedprogasesorias'
})


async function main(){  
    try{
        let conn = await pool.getConnection();
        //let rows = await pool.query("SELECT * FROM pais");
        let rows = await pool.query({sql:'SELECT * FROM pais'});
        //console.log(rows[0].pais);
        console.log(rows);
        
        
        
    }catch(err){
    }  
}


main();


