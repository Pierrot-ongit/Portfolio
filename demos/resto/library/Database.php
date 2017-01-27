<?php


class Database
{
	private $pdo;


	public function __construct()
	{
		$configuration = new Configuration();

		try
		{
			$this->pdo = new PDO
			(
				$configuration->get('database', 'dsn'),
				$configuration->get('database', 'user'),
				$configuration->get('database', 'password')
			);

			$this->pdo->exec('SET NAMES UTF8');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $pe)
		{
			throw new ErrorException("Impossible de se connecter à la base de données : ".$pe->getMessage());
		}
	}

	public function executeSql($sql, array $values = array())
	{
		try
        {
            $query = $this->pdo->prepare($sql);
            $query->execute($values);
        }
        catch(PDOException $pe)
        {
            throw new ErrorException("Erreur lors de la requête : ".$pe->getMessage());
        }

		return $this->pdo->lastInsertId();
	}

    public function query($sql, array $criteria = array())
    {
        try
        {
            $query = $this->pdo->prepare($sql);
            $query->execute($criteria);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $pe)
        {
            throw new ErrorException("Erreur lors de la requête : ".$pe->getMessage());
        }
    }

    public function queryOne($sql, array $criteria = array())
    {
        try
        {
            $query = $this->pdo->prepare($sql);
            $query->execute($criteria);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $pe)
        {
            throw new ErrorException("Erreur lors de la requête : ".$pe->getMessage());
        }
    }
}