<?php
    class album_DAO{
        public function insert_album($album, $connection){
            try{
                $stmt = $connection->prepare("INSERT INTO album(id_artista, nome_artista, rota_foto, categoria, data, nome) 
                VALUES(:id_artista, :nome_artista, :rota_foto, :categoria, :data, :nome)");
                $stmt->bindValue(':id_artista', $album->getIdArtist());
                $stmt->bindValue(':nome_artista', $album->getArtistName());
                $stmt->bindValue(':rota_foto', $album->getCoverRoute());
                $stmt->bindValue(':categoria', $album->getCategory());
                $stmt->bindValue(':data', $album->getDate());
                $stmt->bindValue(':nome', $album->getName());
                
                $stmt->execute();
                
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function select_id($a, $b, $c, $d, $connection){
            try{
                $stmt = $connection->query("SELECT id FROM album WHERE id_artista = '$a' AND nome_artista = '$b' AND
                rota_foto = '$c' AND nome = '$d'")->fetchAll(PDO::FETCH_OBJ);

                foreach($stmt as $id){
                    $album_id = $id->id;
                }

                return $album_id;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function new_albums_list($connection){
            try{
                $stmt = $connection->query("SELECT * FROM album ORDER BY data DESC LIMIT 10")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function my_albums_list($connection, $id){
            try{
                $stmt = $connection->query("SELECT * FROM album WHERE id_artista = '$id' ORDER BY data DESC")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function album_info($connection, $id){
            try{
                $stmt = $connection->query("SELECT * FROM album WHERE id = '$id'")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function filter_albums_list($connection, $category){
            try{
                $stmt = $connection->query("SELECT * FROM album WHERE categoria LIKE '%$category%'
                ORDER BY data DESC LIMIT 50")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function filter_albums_list_parm($connection, $parm){
            try{
                $stmt = $connection->query("SELECT * FROM album WHERE nome LIKE '%$parm%'
                ORDER BY data DESC LIMIT 50")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function filter_albums_list_parm_2($connection, $parm){
            try{
                $stmt = $connection->query("SELECT * FROM album WHERE nome_artista LIKE '%$parm%'
                ORDER BY data DESC LIMIT 50")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function get_icon($connection, $id){
            try{
                $stmt = $connection->query("SELECT album.rota_foto FROM album INNER JOIN musica ON musica.id_album = 
                album.id AND musica.id = '$id'")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function last_artist_albums_list($connection, $artist_ad){
            try{
                $stmt = $connection->query("SELECT * FROM album WHERE id_artista = '$artist_ad' 
                ORDER BY data DESC LIMIT 15")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function all_artist_albums_list($connection, $artist_ad){
            try{
                $stmt = $connection->query("SELECT * FROM album WHERE id_artista = '$artist_ad' 
                ORDER BY data DESC")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function new_artists_albums_list($connection, $id){
            try{
                $stmt = $connection->query("SELECT album.* FROM album INNER JOIN follow ON follow.id_ouvinte = '$id' 
                AND album.id_artista = follow.id_artista ORDER BY data DESC LIMIT 50")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function delete_album($connection, $id){
            try{
                $stmt = $connection->prepare("DELETE FROM musica WHERE id_album = :id");
                $stmt->bindValue(":id", $id);

                $stmt2 = $connection->prepare("DELETE FROM album WHERE id = :id");
                $stmt2->bindValue(":id", $id);

                $stmt3 = $connection->query("SELECT rota_foto FROM album WHERE id = '$id'")->fetchAll(PDO::FETCH_OBJ);
                
                $stmt4 = $connection->query("SELECT rota_musica FROM musica WHERE id_album = '$id'")->fetchAll(PDO::FETCH_OBJ);

                foreach($stmt3 as $image_d){
                    $directory = $image_d->rota_foto;
                }

                unlink("../assets/images/album_images/".$directory);

                foreach($stmt4 as $file_song){
                    $directory_song = $file_song->rota_musica;

                    unlink("../assets/audio/".$directory_song);
                }

                $stmt->execute();
                $stmt2->execute();
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function my_album_info($connection, $id){
            try{
                $stmt = $connection->query("SELECT * FROM album WHERE id = '$id'")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function edit_album($i, $connection){
            try{
                $stmt = $connection->prepare("UPDATE album SET nome = ?, nome_artista = ? WHERE id = ?");
    
                $stmt->bindValue(1, $i->getName());
                $stmt->bindValue(2, $i->getArtistName());
                $stmt->bindValue(3, $i->getId());
    
                $stmt->execute();
    
                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage();
    
                return false;
            }
        }
    }
