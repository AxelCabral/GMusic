<?php
    class music_DAO{
        public function insert_music($music, $connection){
            include_once ('classes/music.php');
            try{
                $stmt = $connection->prepare("INSERT INTO musica(id_album, nome, rota_musica, duration)
                VALUES(:id_album, :nome, :rota_musica, :duration)");
                $stmt->bindValue(':id_album', $music->getIdAlbum());
                $stmt->bindValue(':nome', $music->getName());
                $stmt->bindValue(':rota_musica', $music->getMusicRoute());
                $stmt->bindValue(':duration', $music->getDuration());
                
                $stmt->execute();
                
                return true;

            }catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function top_songs_list($connection){
            try{
                $stmt = $connection->query("SELECT musica.id, musica.id_album, musica.nome, musica.rota_musica, album.id_artista, 
                album.nome_artista, album.rota_foto FROM musica INNER JOIN album WHERE musica.id_album = album.id ORDER BY 
                musica.add_playlist DESC LIMIT 10")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function album_songs_list($connection, $id){
            try{
                $stmt = $connection->query("SELECT * FROM musica WHERE id_album = '$id'")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function favorite_verification($connection, $music_id, $user_id){
            try{
                $stmt = $connection->query("SELECT * FROM fav_musica WHERE id_musica = '$music_id' AND id_usuario =
                '$user_id'")->fetchAll(PDO::FETCH_OBJ);

                if($stmt != null){
                    return true;
                }
                else{
                    return false;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function fav_list($connection, $user_id){
            try{
                $stmt = $connection->query("SELECT musica.*, album.rota_foto, album.nome_artista, album.data,
                album.id_artista FROM musica INNER JOIN fav_musica ON musica.id = fav_musica.id_musica AND fav_musica.id_usuario = '$user_id' 
                INNER JOIN album ON musica.id_album = album.id")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function playlist_songs_list($connection, $id){
            try{
                $stmt = $connection->query("SELECT musica.*, album.rota_foto, album.nome_artista, album.id_artista FROM musica 
                INNER JOIN playlist_song ON playlist_song.id_musica = musica.id AND playlist_song.id_playlist = '$id' 
                INNER JOIN album ON musica.id_album = album.id ORDER BY id_musica")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function favorite_song($connection, $user_id, $music_id){
            try{
                $stmt = $connection->prepare("INSERT INTO fav_musica(id_musica, id_usuario)
                VALUES(:id_musica, :id_usuario)");

                $stmt->bindValue(':id_musica', $music_id);
                $stmt->bindValue(':id_usuario', $user_id);

                $stmt->execute();

                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function remove_favorite_song($connection, $user_id, $music_id){
            try{
                $stmt = $connection->prepare("DELETE FROM fav_musica WHERE id_musica = :id_musica AND id_usuario = 
                :id_usuario");

                $stmt->bindValue(':id_musica', $music_id);
                $stmt->bindValue(':id_usuario', $user_id);

                $stmt->execute();

                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function best_artist_songs($connection, $artist_id){
            try{
                $stmt = $connection->query("SELECT musica.*, album.rota_foto FROM musica INNER JOIN album ON musica.id_album
                = album.id AND album.id_artista = '$artist_id' ORDER BY musica.add_playlist DESC LIMIT 15")
                ->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function delete_song($connection, $id){
            try{
                $stmt = $connection->prepare("DELETE FROM musica WHERE id = :id");
                $stmt->bindValue(":id", $id);
                
                $stmt2 = $connection->query("SELECT rota_musica FROM musica WHERE id = '$id'")->fetchAll(PDO::FETCH_OBJ);

                foreach($stmt2 as $file_song){
                    $directory = $file_song->rota_musica;
                }

                unlink("../assets/audio/".$directory);

                $stmt->execute();
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function song_list_parm($connection, $parm){
            try{
                $stmt = $connection->query("SELECT musica.id, musica.id_album, musica.nome, album.id_artista, 
                album.nome_artista, album.rota_foto FROM musica INNER JOIN album WHERE musica.id_album = album.id
                AND musica.nome LIKE '%$parm%' ORDER BY 
                musica.add_playlist DESC LIMIT 50")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function my_songs($connection, $id){
            try{
                $stmt = $connection->query("SELECT musica.add_playlist, album.data FROM musica INNER JOIN album ON 
                album.id_artista = '$id' AND musica.id_album = album.id")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
    }
