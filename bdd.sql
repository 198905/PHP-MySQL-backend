#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: catégorie
#------------------------------------------------------------

CREATE TABLE categorie(
        idCategorie          Int  Auto_increment  NOT NULL ,
        nomCategorie         Text NOT NULL ,
        descriptionCategorie Text NOT NULL
,CONSTRAINT categorie_PK PRIMARY KEY (idCategorie)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: articles
#------------------------------------------------------------

CREATE TABLE articles(
        id                     Int  Auto_increment  NOT NULL ,
        titreArticle           Varchar (5) NOT NULL ,
        dateCreationArticle    Date NOT NULL ,
        datePublicationArticle Date NOT NULL ,
        contenuArticle         Text NOT NULL ,
        statutArticle          Enum ("publié","corbeille","brouillon") NOT NULL ,
        idCategorie            Int
,CONSTRAINT articles_PK PRIMARY KEY (id)

,CONSTRAINT articles_categorie_FK FOREIGN KEY (idCategorie) REFERENCES categorie(idCategorie)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: tags
#------------------------------------------------------------

CREATE TABLE tags(
        idTag          Int  Auto_increment  NOT NULL ,
        nomTag         Text NOT NULL ,
        descriptionTag Text NOT NULL
,CONSTRAINT tags_PK PRIMARY KEY (idTag)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: envoie à
#------------------------------------------------------------

CREATE TABLE envoie_a(
        idTag Int NOT NULL ,
        id    Int NOT NULL
,CONSTRAINT envoie_a_PK PRIMARY KEY (idTag,id)

,CONSTRAINT envoie_a_tags_FK FOREIGN KEY (idTag) REFERENCES tags(idTag)
,CONSTRAINT envoie_a_articles0_FK FOREIGN KEY (id) REFERENCES articles(id)
)ENGINE=InnoDB;
