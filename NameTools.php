<?php
/**
 * Created by SimplyRin on 2019/04/02.
 *
 * Copyright (c) 2019 SimplyRin
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
class NameTools {
	public function getIdFromName($name) {
		$value = $this->getJsonObject('playerNames', $name)['data'][0]['id'];
		if ($value == '') {
			return 'error';
			exit;
		}
		return $value;
	}

	public function getNameFromId($id) {
		$value = $this->getJsonObject('playerIds', $id)['data'][0]['attributes']['name'];
		if ($value == '') {
			return 'error';
			exit;
		}
		return $value;
	}

	public function getJsonObject($type, $name) {
		$name = trim($name);
		if ($name == '') {
			print('Failed...');
			return;
		}

		$endPoint = "https://api.pubg.com/shards/steam/players?filter[" . $type . "]=" . $name;

		$apiKey = "API_KEY";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $endPoint);
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['User-Agent: Mozilla/5.0', 'Authorization: Bearer ' . $apiKey, 'Accept: application/vnd.api+json']);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_TIMEOUT, 5);
		$json = curl_exec($curl);
		curl_close($curl);
		return json_decode($json, true);
	}
}
?>
