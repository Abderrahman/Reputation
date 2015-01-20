<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    const CX = '009842631161325663799:mublut__pqm'; // Fake Search engine ID
    const KEY = 'AIzaByA6MUk9FkG3V3A1UviFD4RVPz0RqMUula1'; // Fake API key

    public function __construct() {
        parent::__construct();

        $this->load->model('util');
        $this->util->cache();
    }

    public function index() {

        $this->load->view('header', array('page' => 'Home'));
        $this->load->view('form');
        $this->load->model('client');
        $this->load->model('resultat');

        $query = $this->input->post('search', TRUE);
        $gl = $this->input->post('gl', TRUE);

        if (!empty($query)) {

            $url = "https://www.googleapis.com/customsearch/v1?key=" . $this::KEY . "&cx=" .
                    $this::CX . "&num=10&start=1&gl=" . $gl . "&q=" . urlencode($query);

            //$url = base_url() . 'public/v1.json';
            
            $body = @file_get_contents($url);
            if ($body === false) {

                $this->load->view('error', array('msg' => "Message 403 : Daily Limit Exceeded"));
            } else {

                $json = json_decode($body);
                $tr = $json->queries->request[0]->totalResults; // 10

                if ($tr == 0) {
                    $this->load->view('error', array('msg' => 'Your search - ' . $query . ' - did not match any documents.'));
                    goto end;
                } else {

                    $client = new Client();
                    $client->query = $query;
                    $client->insert();
                    $this->load->view('input', array('id' => $client->id));
                }

                $data = array();
                for ($j = 0; $j < count($json->items); $j++) {

                    $resultat = new Resultat();

                    $resultat->titre = $json->items[$j]->title;
                    $resultat->link = $json->items[$j]->link;
                    $resultat->snippet = $json->items[$j]->snippet; // to remove
                    $resultat->position = $j + 1;
                    $resultat->idClient = $client->id;
                    $resultat->insert();

                    $data['r'][] = array(
                        'link' => $json->items[$j]->link,
                        'htmlTitle' => $json->items[$j]->htmlTitle,
                        'htmlFormattedUrl' => $json->items[$j]->htmlFormattedUrl,
                        'htmlSnippet' => $json->items[$j]->htmlSnippet,
                        'n' => $j + 1
                    );
                }

                $this->load->view('resultat', $data);
            }
        }
        end:
        $this->load->view('footer', array('jsfile' => 'scripts'));
    }

}
