<?php
    class user_DAO{
        public function insert_user($user, $connection){
            include_once ('classes/user.php');
            try{
                $stmt = $connection->prepare("INSERT INTO usuario(nome, email, icone, senha, tipo) 
                VALUES(:nome, :email, :icone, :senha, :tipo)");
                $stmt->bindValue(':nome', $user->getName());
                $stmt->bindValue(':email', $user->getEmail());
                $stmt->bindValue(':icone', $user->getIcon());
                $stmt->bindValue(':senha', $user->getPassword());
                $stmt->bindValue(':tipo', $user->getType());
                
                $stmt->execute();
                
                return true;

            }catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function login($email, $pass, $connection){
            try{
                $stmt = $connection->query("SELECT * FROM usuario WHERE email = '$email' AND senha = '$pass'")->fetchAll(PDO::FETCH_OBJ);
                
                foreach($stmt as $user){
                    $_SESSION['id'] = $user->id; //Salva o id do usuário
                    $_SESSION['type'] = $user->tipo; //Salva o tipo de usuário (artista/ouvinte)
                    $_SESSION['icon'] = $user->icone; // Salva o caminho da imagem(icone) do usuario
        
                    //Pegar somente o primeiro Nome do usuario
                    $full_name = $user->nome;
                    $words = explode(" ", $full_name);
                    $first_name = $words[0];

                    $_SESSION['name'] = $first_name;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function my_profile_info($connection, $id){
            try{
                $stmt = $connection->query("SELECT * FROM usuario WHERE id = '$id'")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function delete_account($connection, $id){
            try{
                $stmt2_confirmation = false;

                $stmt1 = $connection->prepare("DELETE FROM fav_musica WHERE id_usuario = :id");
                $stmt1->bindValue(":id", $id);

                $stmt_s1 = $connection->query("SELECT album.id FROM album INNER JOIN musica WHERE album.id_artista 
                = 'id' AND musica.id_album = album.id")->fetchAll(PDO::FETCH_OBJ);

                foreach($stmt_s1 as $new_id){
                    $album_id = $new_id->id;
                    $stmt2_confirmation = true;
                }

                if($stmt2_confirmation == true){
                    $stmt2 = $connection->prepare("DELETE FROM musica WHERE id_album = :id");
                    $stmt2->bindValue(":id", $album_id);

                    $stmt2->execute();
                }

                $stmt3 = $connection->prepare("DELETE FROM album WHERE id_artista = :id");
                $stmt3->bindValue(":id", $id);

                $stmt4 = $connection->prepare("DELETE FROM follow WHERE id_ouvinte = :id OR id_artista = :id");
                $stmt4->bindValue(":id", $id);

                $stmt_s2 = $connection->query("SELECT playlist.id FROM playlist INNER JOIN playlist_song WHERE 
                playlist.id_usuario = '$id' AND playlist_song.id_playlist = playlist.id")->fetchAll(PDO::FETCH_OBJ);

                foreach($stmt_s2 as $new_id){
                    $playlist_id = $new_id->id;
                }

                $stmt5 = $connection->prepare("DELETE FROM playlist_song WHERE id_playlist = :id");
                $stmt5->bindValue(":id", $playlist_id);

                $stmt6 = $connection->prepare("DELETE FROM playlist WHERE id_usuario = :id");
                $stmt6->bindValue(":id", $id);

                $stmt_icon = $connection->query("SELECT icone FROM usuario WHERE id = '$id'")->fetchAll(PDO::FETCH_OBJ);
                $stmt_album_images = $connection->query("SELECT rota_foto, id_artista FROM  album WHERE id_artista = '$id'")->fetchAll(PDO::FETCH_OBJ);
                $stmt_songs = $connection->query("SELECT rota_musica, id_album FROM musica");

                foreach($stmt_icon as $icon){
                    $icon_d = $icon->icone;
                }

                foreach($stmt_album_images as $image){
                    $image_d = $image->rota_foto;

                    unlink("../assets/images/album_images/".$image_d);
                }

                $stmt7 = $connection->prepare("DELETE FROM usuario WHERE id = :id");
                $stmt7->bindValue(":id", $id);

                $stmt1->execute();
                $stmt3->execute();
                $stmt4->execute();
                $stmt5->execute();
                $stmt6->execute();
                $stmt7->execute();

                unlink("../assets/images/user_images/".$icon_d);
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function edit_profile($i, $connection){
            try{
                $stmt = $connection->prepare("UPDATE usuario SET nome = ?, email = ?, senha = ? WHERE id = ?");
    
                $stmt->bindValue(1, $i->getName());
                $stmt->bindValue(2, $i->getEmail());
                $stmt->bindValue(3, $i->getPassword());
                $stmt->bindValue(4, $i->getId());
    
                $stmt->execute();
    
                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage();
    
                return false;
            }
        }
        public function artist_info($connection, $id){
            try{
                $stmt = $connection->query("SELECT nome, icone FROM usuario WHERE id = '$id'")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }

        public function artist_followers($connection, $id){
            try{
                $stmt = $connection->query("SELECT * FROM follow WHERE id_artista = '$id'")->fetchAll(PDO::FETCH_OBJ);

                return $stmt;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function new_follow($connection, $artist_id, $user_id, $date){
            try{
                $stmt = $connection->prepare("INSERT INTO follow(id_ouvinte, id_artista, data)
                VALUES(:id_ouvinte, :id_artista, :data)");

                $stmt->bindValue(':id_ouvinte', $user_id);
                $stmt->bindValue(':id_artista', $artist_id);
                $stmt->bindValue(':data', $date);

                $stmt->execute();

                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
        public function remove_follow($connection, $artist_id, $user_id){
            try{
                $stmt = $connection->prepare("DELETE FROM follow WHERE id_ouvinte = :id_ouvinte
                AND id_artista = :id_artista");

                $stmt->bindValue(':id_ouvinte', $user_id);
                $stmt->bindValue(':id_artista', $artist_id);

                $stmt->execute();

                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage();

                return false;
            }
        }
    }
