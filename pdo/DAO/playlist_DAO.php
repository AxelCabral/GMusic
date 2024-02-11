<?php
    class playlist_DAO{
        public function my_playlist_list($connection, $id){
            try{
                $stmt = $connection->query("SELECT * FROM playlist WHERE id_usuario = '$id' 
                ORDER BY data DESC")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function insert_playlist($playlist, $connection){

            include_once('classes/playlist.php');

            try{
                $stmt = $connection->prepare("INSERT INTO playlist(nome, data, rota_foto, id_usuario) 
                VALUES(:nome, :data, :rota_foto, :id_usuario)");
                $stmt->bindValue(':nome', $playlist->getName());
                $stmt->bindValue(':data', $playlist->getDate());
                $stmt->bindValue(':rota_foto', $playlist->getCoverRoute());
                $stmt->bindValue(':id_usuario', $playlist->getIdUser());
                
                $stmt->execute();
                
                return true;
                
            }catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function playlist_info($connection, $id){
            try{
                $stmt = $connection->query("SELECT * FROM playlist WHERE id = '$id'")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function delete_playlist($connection, $id){
            try{
                $stmt = $connection->prepare("DELETE FROM playlist_song WHERE id_playlist = :id");
                $stmt->bindValue(":id", $id);

                $stmt3 = $connection->query("SELECT rota_foto FROM playlist WHERE id = '$id'")->fetchAll(PDO::FETCH_OBJ);

                $stmt2 = $connection->prepare("DELETE FROM playlist WHERE id = :id");
                $stmt2->bindValue(":id", $id);
                
                foreach($stmt3 as $image_d){
                    $directory = $image_d->rota_foto;
                }

                $stmt->execute();
                $stmt2->execute();

                unlink("../assets/images/playlist_images/".$directory);
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function playlist_list($connection, $user_id){
            try{
                $stmt = $connection->query("SELECT * FROM playlist WHERE id_usuario = 
                '$user_id'")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function add_playlist_song($connection, $playlist_id, $music_id){
            try{
                $stmt = $connection->prepare("INSERT INTO playlist_song(id_playlist, id_musica)
                VALUES(:id_playlist, :id_musica)");

                $stmt->bindValue(':id_playlist', $playlist_id);
                $stmt->bindValue(':id_musica', $music_id);

                $stmt2 = $connection->query("SELECT add_playlist FROM musica WHERE id = '$music_id'")->fetchAll(PDO::FETCH_OBJ);

                foreach($stmt2 as $getNumber){
                    $numb = ($getNumber->add_playlist+1);
                }

                $stmt3 = $connection->prepare("UPDATE musica SET add_playlist = ? WHERE id = ?");
    
                $stmt3->bindValue(1, $numb);
                $stmt3->bindValue(2, $music_id);
    
                $stmt->execute();
                $stmt3->execute();

                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function remove_playlist_song($connection, $playlist_id, $music_id){
            try{
                $stmt = $connection->prepare("DELETE FROM playlist_song WHERE id_playlist = :id_playlist 
                AND id_musica = :id_musica LIMIT 1");

                $stmt->bindValue(':id_playlist', $playlist_id);
                $stmt->bindValue(':id_musica', $music_id);

                $stmt2 = $connection->query("SELECT add_playlist FROM musica WHERE id = '$music_id'")->fetchAll(PDO::FETCH_OBJ);

                foreach($stmt2 as $getNumber){
                    $numb = ($getNumber->add_playlist-1);
                }

                $stmt3 = $connection->prepare("UPDATE musica SET add_playlist = ? WHERE id = ?");
    
                $stmt3->bindValue(1, $numb);
                $stmt3->bindValue(2, $music_id);

                $stmt->execute();
                $stmt3->execute();

                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
    }
