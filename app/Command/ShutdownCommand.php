<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Command;

use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\IPReaderInterface;
use Hyperf\Nacos\Application;
use Psr\Container\ContainerInterface;

#[Command]
class ShutdownCommand extends HyperfCommand
{
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct('shutdown');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('删除实例');
    }

    public function handle()
    {
        $config = $this->container->get(ConfigInterface::class);

        $serviceConfig = $config->get('services.drivers.nacos', []);
        $serviceName = 'CalculatorService';
        $groupName = $serviceConfig['group_name'] ?? null;
        $namespaceId = $serviceConfig['namespace_id'] ?? null;
        $instanceConfig = $serviceConfig['instance'] ?? [];
        $ephemeral = $serviceConfig['ephemeral'] ?? null;
        $cluster = $instanceConfig['cluster'] ?? null;

        $ip = di()->get(IPReaderInterface::class)->read();

        $client = $this->container->get(Application::class);
        $ports = $config->get('server.servers', []);
        foreach ($ports as $portServer) {
            $port = (int) $portServer['port'];
            $response = $client->instance->delete($serviceName, $groupName, $ip, $port, [
                'clusterName' => $cluster,
                'namespaceId' => $namespaceId,
                'ephemeral' => $ephemeral,
            ]);

            if ($response->getStatusCode() === 200) {
                $this->output->writeln(sprintf('Instance %s:%d deleted successfully!', $ip, $port));
            } else {
                $this->output->writeln(sprintf('Instance %s:%d deleted failed!', $ip, $port));
            }
        }
    }
}
