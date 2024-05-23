class Url extends Model {
    public function find($shortUrl) {
        $this->db->query("SELECT * FROM urls WHERE short_url = :short_url");
        $this->db->bind(':short_url', $shortUrl);
        return $this->db->single();
    }

    public function store($originalUrl, $shortUrl) {
        $this->db->query("INSERT INTO urls (original_url, short_url) VALUES (:original_url, :short_url)");
        $this->db->bind(':original_url', $originalUrl);
        $this->db->bind(':short_url', $shortUrl);
        return $this->db->execute();
    }

    public function exists($originalUrl) {
        $this->db->query("SELECT * FROM urls WHERE original_url = :original_url");
        $this->db->bind(':original_url', $originalUrl);
        return $this->db->single();
    }
}
