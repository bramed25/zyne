% Estructura: pelicula(Id, Categoria, Nombre, Actores, Duracion, Idioma, Anio, Sinopsis, Imagen).

pelicula(1, 'ciencia_ficcion', 'Interstellar', 'Matthew McConaughey, Anne Hathaway', '169 min', 'Ingles/Subtitulada', 2014, 'Un grupo de exploradores prueban los saltos a través de agujeros de gusano en búsqueda de la sobrevivencia de la humanidad.', 'img/interestellar.png').
pelicula(2, 'ciencia_ficcion', 'Volver al Futuro', 'Michael J. Fox, Christopher Loyd, Lea Thompson', '114 min', 'Ingles/Subtitulada', 1985, 'Marty McFly, un estudiante de 17 años, es enviado accidentalmente treinta años al pasado en un artefacto inventado por su amigo.', 'img/volver_futuro.png').
pelicula(3, 'ciencia_ficcion', 'Matrix', 'Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss', '136 min', 'Ingles/Subtitulada', 1999,  'Un hacker se da cuenta por medio de otros rebeldes de la naturaleza de su realidad y su rol en la guerra contra los controladores.', 'img/matrix.png').
pelicula(4, 'ciencia_ficcion', 'Hombres de negro', 'Tommy Lee Jones, Will Smith, Linda Fiorentino', '98 min', 'Ingles/Subtitulada', 1997, 'Un oficial de policía se une a una organización secreta que controla las interacciones extraterrestres en la Tierra.', 'img/mib.png').
pelicula(5, 'ciencia_ficcion', '12 Monos', 'Bruce Willis, Madeleine Stowe, Brad Pitt', '129 min', 'Ingles/Subtitulada', 1995, 'En un mundo futuro devastado por la enfermedad, un convicto es enviado para recopilar información sobre el virus creado por el hombre que acabó con la mayoría de la población humana en el planeta.', 'img/12monos.png').

pelicula(6,'animacion','Spider-Man: Un nuevo universo','Shamek Moore, Jake Johnson, Hailee Steinfeld','177 min','Ingles/Subtitulada', 2018, 'El adolescente Miles Morales es el Spider-Man de su propia realidad y se encontrará con otros como él de otras dimensiones para combatir una amenaza que acecha a todas las realidades.','img/spiderman_universo.png').
pelicula(7,'animacion','Toy Story','Tom Hanks, Tim Allen, Don Rickles','81 min','Ingles/Subtitulada',1995,'Un vaquero se siente profundamente amenazado y celoso cuando un nuevo astronauta lo reemplaza como el mejor juguete en la habitación de un niño.','img/toy_story.png').
pelicula(8,'animacion','Ratatouille','Brad Garret, Lou Romano, Patton Oswalt','111 min','Ingles/Subtitulada',2007,'Una rata que puede cocinar forja una inusual alianza con un joven en un famoso restaurante de París.','img/ratatouille.png').
pelicula(9,'animacion','Coraline y la Puerta Secreta','Dakota Fanning, Teri Hatcher, John Hodgman','100 min','Ingles/Subtitulada',2009,'Una niña aventurera de 11 años encuentra otro mundo que es una versión extrañamente idealizada de su hogar frustrante, pero tiene secretos siniestros.','img/coraline.png').
pelicula(10,'animacion','El libro de la vida','Diego Luna, Zoe Saldaña, Channing Tatum','95 min','Ingles/Subtitulada',2014,'Manolo, un joven que se debate entre cumplir las expectativas de su familia y seguir su corazón, se embarca en una aventura que abarca tres mundos fantásticos donde debe enfrentar sus mayores miedos.','img/libro_vida.png').

pelicula(11,'terror','El exorcista','Ellen Burstyn, Max von Sydow, Linda Blair','122 min','Ingles/Subtitulada',1973,'Cuando una adolescente es poseída por una entidad misteriosa, su madre busca la ayuda de dos sacerdotes para salvar a su hija.','img/exorcista.png').
pelicula(12,'terror','Backrooms','Chiwetel Ejiofor, Renate Reinsve, Mark Duplass','110 min','Ingles/Subtitulada',2026,'Una extraña puerta aparece en el sótano de una sala de exposición de muebles.','img/backrooms.png').
pelicula(13,'terror','El conjuro','Patrick Wilson, Vera Farmiga, Ron Livingston','112 min','Ingles/Subtitulada',2013,'Los investigadores paranormales Ed y Lorraine Warren trabajan para ayudar a una familia aterrorizada por una presencia oscura en su granja.','img/conjuro.png').
pelicula(14,'terror','Siniestro','Ethan Hawke, Juliet Rylance','110 min','Ingles/Subtitulada',2012,'El escritor Ellison Oswalt encuentra una caja de videos que sugiere que el asesino al que está investigando es una es serie cuyo trabajo se remonta a los 60.','img/siniestro.png').
pelicula(15,'terror','La Hora De La Desaparición','Julia Garner, Josh Brolin, Alden Ehrenreich','128 min','Ingles/Subtitulada',2025,'Varias historias interrelacionadas sobre la desaparición de estudiantes de pre-escolar en una pequeña ciudad.','img/desaparicion.png').


%REGLAS
% Obtener todas las películas de una categoría (Para el filtro y vista principal)
filtrar_por_categoria(Cat, Nombre, Imagen) :- 
    pelicula(_, Cat, Nombre, _, _, _, _, _, Imagen).

% Obtener los detalles completos de una película al hacer clic
obtener_detalles(NombreABuscar, Categoria, Actores, Duracion, Idioma, Anio, Sinopsis, Imagen) :- 
    pelicula(_, Categoria, NombreABuscar, Actores, Duracion, Idioma, Anio, Sinopsis, Imagen).