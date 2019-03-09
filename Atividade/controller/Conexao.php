<?php

class Conexao {

    private static $conexao;
    private static $cache;

    /**
     * @return PDO Objeto de Conexão
     */
    public static function getConexao() {

        if (!self::$conexao) {
            self::$conexao = new PDO("mysql:host=localhost;dbname=webdev;charset=utf8", "root", "");
            self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$conexao;
    }

    /**
     * @return Memcache Objeto de Conexão
     */
    public static function getCache() {

        if (!self::$cache) {
            self::$cache = new Memcache();
            self::$cache->addserver("localhost", 11211);
        }

        return self::$cache;
    }

}
