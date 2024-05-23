class UrlController extends Controller {
    public function index() {
        $this->view('url/index');
    }

    public function shorten() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $originalUrl = $_POST['url'];
            if ($this->isValidUrl($originalUrl)) {
                $urlModel = $this->model('Url');

                $existingUrl = $urlModel->exists($originalUrl);
                if ($existingUrl) {
                    $this->view('url/index', ['short_url' => $existingUrl->short_url]);
                } else {
                    $shortUrl = $this->generateShortUrl();
                    $urlModel->store($originalUrl, $shortUrl);
                    $this->view('url/index', ['short_url' => $shortUrl]);
                }
            } else {
                $this->view('url/index', ['error' => 'Geçersiz URL']);
            }
        } else {
            $this->view('url/index');
        }
    }

    public function redirect($shortUrl) {
        $urlModel = $this->model('Url');
        $urlRecord = $urlModel->find($shortUrl);
        if ($urlRecord) {
            header('Location: ' . $urlRecord->original_url);
        } else {
            $this->view('url/404');
        }
    }

    private function isValidUrl($url) {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    private function generateShortUrl() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
        $shortUrl = '';
        for ($i = 0; $i < 12; $i++) {
            $shortUrl .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $shortUrl;
    }
}
