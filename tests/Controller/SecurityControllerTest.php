<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testCantConnect()
    {
        $client = static::createClient();
        $client->request('GET', '/admin/article-list');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testLoginForm(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $this->assertSame(1, $crawler->filter('button:contains("Se connecter")')->count());
        $this->assertSame(1,  $crawler->filter('#inputEmail')->count());
        $this->assertSame(1,  $crawler->filter('#inputPassword')->count());

        $form = $crawler->selectButton('Se connecter')->form();
        $form['email'] = 'admin@admin.fr';
        $form['password'] = 'admin';
        $crawler = $client->submit($form);

        }
    public function testIndex(){
        $client = static::createClient();
        $client->request('GET', '/admin/article-list');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $client->clickLink('test');

        }

}
